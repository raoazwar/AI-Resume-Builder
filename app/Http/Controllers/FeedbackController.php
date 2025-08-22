<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'type' => 'required|in:general,bug,feature,improvement',
            'message' => 'required|string|max:1000',
            'allow_contact' => 'boolean',
        ]);

        $feedback = Auth::user()->feedback()->create($validated);

        return response()->json([
            'message' => 'Feedback submitted successfully!',
            'feedback' => $feedback
        ], 201);
    }

    public function index(): JsonResponse
    {
        $feedback = Auth::user()->feedback()->latest()->get();

        return response()->json([
            'feedback' => $feedback
        ]);
    }
}
