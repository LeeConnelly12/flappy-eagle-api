<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class LeaderboardController extends Controller
{
    /**
     * Display a listing of submissions.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'submissions' => Submission::query()->select('name', 'score')->limit(10)->get(),
        ]);
    }

    /**
     * Store a newly created submission in storage.
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'score' => ['required', 'integer', 'min:1', 'max:65535'],
        ]);

        Submission::query()->create([
            'name' => $request->name,
            'score' => $request->score,
        ]);

        return response()->noContent(201);
    }
}