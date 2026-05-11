<?php

use App\Models\User;

it('creates a new idea', function () {
    $this->actingAs($user = User::factory()->create());
    visit('/ideas')
        ->click('@create-idea-button')
        ->fill('title', 'Some Example Title')
        ->click('@button-status-completed')
        ->fill('description', 'An example description')
        ->fill('@new-link', 'https://laracasts.com')
        ->click('@submit-new-link-button')
        ->fill('@new-link', 'https://laravel.com')
        ->click('@submit-new-link-button')
        ->fill('@new-step', 'Do step 1')
        ->click('@submit-new-step-button')
        ->fill('@new-step', 'Do step 2')
        ->click('@submit-new-step-button')
        ->click('Create')
        ->assertPathIs('/ideas')
        ->assertSee('Some Example Title')
        ->assertNoJavaScriptErrors();

    expect($idea = $user->ideas()->first())->toMatchArray([
        'title' => 'Some Example Title',
        'status' => 'completed',
        'description' => 'An example description',
        'links' => ['https://laracasts.com', 'https://laravel.com'],
    ]);
    expect($idea->steps)->toHaveCount(2);
});
