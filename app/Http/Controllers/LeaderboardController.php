<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubmissionResource;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class LeaderboardController extends Controller
{
    /**
     * Display a listing of submissions.
     */
    public function index(): ResourceCollection
    {
        $submissions = Submission::query()
            ->select('name', 'score')
            ->limit(10)
            ->orderByDesc('score')
            ->get();

        return SubmissionResource::collection($submissions);
    }

    /**
     * Store a newly created submission in storage.
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'string', 'max:12'],
            'score' => ['required', 'integer', 'min:1', 'max:65535'],
        ]);

        Submission::query()->create([
            'name' => $request->name,
            'score' => $request->score,
        ]);

        return response()->noContent(201);
    }
}