<?php

use App\Models\User;
use App\Notifications\EmailChanged;
use Illuminate\Support\Facades\Notification;

it('requires authentication', function () {
    visit(route('profile.edit'))->assertPathIs('/login');
    // This is the same test as above except a browser is not opened.
    $this->get(route('profile.edit'))->assertRedirect(('/login'));
});

it('edits a profile', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    visit(route('profile.edit'))
        ->assertValue('name', $user->name)
        ->fill('name', 'New Name')
        ->assertValue('email', $user->email)
        ->fill('email', 'new@example.com')
        ->click('Update Account')
        ->assertSee('Profile updated!');

    expect($user->fresh())->toMatchArray([
        'name' => 'New Name',
        'email' => 'new@example.com',
    ]);
});

it('notifies the original email if updated', function () {
    $user = User::factory()->create();
    $originalEmail = $user->email;
    $this->actingAs($user);
    Notification::fake();
    visit(route('profile.edit'))
        ->assertValue('email', $user->email)
        ->fill('email', 'new@example.com')
        ->click('Update Account')
        ->assertSee('Profile updated!');
    Notification::assertSentOnDemand(EmailChanged::class, function (EmailChanged $notification, $routes, $notifiable) use ($originalEmail) {
        return $notifiable->routes['mail'] === $originalEmail;
    });
});
