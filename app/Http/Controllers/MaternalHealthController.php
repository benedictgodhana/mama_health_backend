<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;use App\Models\MaternalHealthRecord;

class MaternalHealthController extends Controller
{
      public function store(Request $request)
    {
        if (!auth()->user()->hasPermissionTo('create_maternal_record')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'visit_date' => 'required|date',
            'gestational_age' => 'nullable|integer|min:0',
            'weight' => 'nullable|numeric|min:0',
            'blood_pressure' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = auth()->user();
        if ($user->hasRole('mother') && $request->user_id != $user->id) {
            return response()->json(['error' => 'Mothers can only create records for themselves'], 403);
        }

        $record = MaternalHealthRecord::create([
            'user_id' => $request->user_id,
            'created_by' => $user->id,
            'visit_date' => $request->visit_date,
            'gestational_age' => $request->gestational_age,
            'weight' => $request->weight,
            'blood_pressure' => $request->blood_pressure,
            'notes' => $request->notes,
        ]);

        return response()->json(['message' => 'Maternal record created successfully', 'record' => $record], 201);
    }
}
