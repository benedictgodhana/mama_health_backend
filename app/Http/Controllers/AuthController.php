<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OtpCode;
use App\Notifications\OtpNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Register a new user and send OTP for phone verification.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'nullable|email|unique:users,email',
            'phone'     => 'required|digits_between:10,15|unique:users,phone',
            'pin'       => 'required|digits:4',
            'gender'    => 'nullable|in:Male,Female,Other',
            'id_type'   => 'required|string|in:national_id,passport,military_id,alien_id,birth_certificate',
            'id_number' => 'required|string|unique:users,id_number',
            'role'      => 'string|in:mother,health_worker,admin',
            'channel'   => 'nullable|in:sms,whatsapp',
        ]);

        if ($validator->fails()) {
            Log::warning('Registration validation failed', ['errors' => $validator->errors()->toArray()]);
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $otp = rand(1000, 9999); // Replace with secure OTP generation in production

            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'pin'       => Hash::make($request->pin), // Ensure pin is hashed
                'gender'    => $request->gender,
                'id_type'   => $request->id_type,
                'id_number' => $request->id_number,
            ]);

            $user->assignRole($request->role ?? 'mother');

            OtpCode::create([
                'phone'      => $request->phone,
                'otp'        => $otp,
                'expires_at' => Carbon::now()->addMinutes(10),
            ]);

            // Only send SMS/WhatsApp in production
            if (app()->environment('production')) {
                $channel = $request->input('channel', 'sms');
                (new OtpNotification($otp, $channel))->toTwilio($user);
            }

            Log::info("Generated OTP for {$user->phone}", ['otp' => $otp]);

            return response()->json(['message' => 'OTP sent to your phone'], 201);
        } catch (\Exception $e) {
            Log::error('Registration failed', [
                'error' => $e->getMessage(),
                'phone' => $request->phone,
            ]);
            return response()->json(['error' => 'Registration failed'], 500);
        }
    }

    /**
     * Verify OTP during registration and issue access token.
     */
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_number' => 'required|string',
            'otp'       => 'required|digits:4',
        ]);

        if ($validator->fails()) {
            Log::warning('OTP verification validation failed', ['errors' => $validator->errors()->toArray()]);
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Find user by id_number to get phone
            $user = User::where('id_number', $request->id_number)->first();
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $otpCode = OtpCode::where('phone', $user->phone)
                ->where('otp', $request->otp)
                ->where('expires_at', '>', Carbon::now())
                ->first();

            if (!$otpCode) {
                return response()->json(['error' => 'Invalid or expired OTP'], 401);
            }

            $user->markPhoneAsVerified(); // Update if this is still relevant
            $otpCode->delete();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'user' => [
                    'id'        => $user->id,
                    'name'      => $user->name,
                    'email'     => $user->email,
                    'phone'     => $user->phone,
                    'gender'    => $user->gender,
                    'id_type'   => $user->id_type,
                    'id_number' => $user->id_number,
                    'roles'     => $user->getRoleNames()->toArray(),
                ],
            ], 200);
        } catch (\Exception $e) {
            Log::error('OTP verification error', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'OTP verification failed'], 500);
        }
    }

    /**
     * Step 1 of login: validate ID type + ID number + PIN, then send OTP.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_type'   => 'required|string|in:national_id,passport,military_id,alien_id,birth_certificate',
            'id_number' => 'required|string',
            'pin'       => 'required|digits:4',
            'channel'   => 'nullable|in:sms,whatsapp',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $user = User::where('id_type', $request->id_type)
                ->where('id_number', $request->id_number)
                ->first();

            if (!$user || !Hash::check($request->pin, $user->pin)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            $otp = rand(1000, 9999); // Replace with secure OTP generation in production

            OtpCode::updateOrCreate(
                ['phone' => $user->phone],
                [
                    'otp'        => $otp,
                    'expires_at' => Carbon::now()->addMinutes(10),
                ]
            );

            // Only send SMS/WhatsApp in production
            if (app()->environment('production')) {
                $channel = $request->input('channel', 'sms');
                (new OtpNotification($otp, $channel))->toTwilio($user);
            }

            Log::info("Generated OTP for {$user->phone}", ['otp' => $otp]);

            return response()->json(['message' => 'OTP sent to your phone'], 200);
        } catch (\Exception $e) {
            Log::error('Login error', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Login failed'], 500);
        }
    }

    /**
     * Step 2 of login: verify OTP and issue token.
     */
    public function verifyLoginOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_type'   => 'required|string|in:national_id,passport,military_id,alien_id,birth_certificate',
            'id_number' => 'required|string',
            'otp'       => 'required|digits:4',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $user = User::where('id_type', $request->id_type)
                ->where('id_number', $request->id_number)
                ->first();

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $otpCode = OtpCode::where('phone', $user->phone)
                ->where('otp', $request->otp)
                ->where('expires_at', '>', Carbon::now())
                ->first();

            if (!$otpCode) {
                return response()->json(['error' => 'Invalid or expired OTP'], 401);
            }

            $otpCode->delete();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'user' => [
                    'id'        => $user->id,
                    'name'      => $user->name,
                    'email'     => $user->email,
                    'phone'     => $user->phone,
                    'gender'    => $user->gender,
                    'id_type'   => $user->id_type,
                    'id_number' => $user->id_number,
                    'roles'     => $user->getRoleNames()->toArray(),
                ],
            ], 200);
        } catch (\Exception $e) {
            Log::error('Login OTP verification error', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Login OTP verification failed'], 500);
        }
    }
}
