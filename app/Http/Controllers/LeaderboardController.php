<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'submissions' => Submission::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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