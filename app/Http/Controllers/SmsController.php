<?php
namespace App\Http\Controllers;

use App\Notifications\OtpNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SmsController extends Controller
{
    public function send(Request $request)
    {
        $user = Auth::user();
        if (!$user || !$user->hasPermissionTo('send_sms')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
            'message' => 'required|string|max:160',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Use a custom notification or Twilio directly
            $user = auth()->user();
            $user->notify(new OtpNotification($request->message)); // Reuse OtpNotification for simplicity
            return response()->json(['message' => 'SMS sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send SMS: ' . $e->getMessage()], 500);
        }
    }
}
