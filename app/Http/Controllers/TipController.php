<?php
namespace App\Http\Controllers;

use App\Models\Tip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipController extends Controller
{
    public function index()
    {
        if (!auth()->user()->hasPermissionTo('view_tip')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $tips = Tip::all();
        return response()->json(['tips' => $tips]);
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasPermissionTo('create_tip')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $tip = Tip::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json(['message' => 'Tip created successfully', 'tip' => $tip], 201);
    }
}
