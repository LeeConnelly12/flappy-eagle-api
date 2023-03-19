<?php

use App\Models\Submission;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can fetch submissions', function () {
    $submissions = Submission::factory()->count(3)->create();

    get('/api/leaderboard')
        ->assertOk()
        ->assertJsonCount(3, 'data')
        ->assertJsonFragment([
            'name' => $submissions->first()->name,
            'score' => $submissions->first()->score,
        ]);
});

it('can save a submission', function () {
    post('/api/leaderboard', [
                'name' => 'john doe',
                'score' => 15,
            ])
        ->assertCreated();

    assertDatabaseHas(Submission::class, [
        'name' => 'john doe',
        'score' => 15,
    ]);
});