<?php

use App\Livewire\Admin\Login;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('redirects guests to the admin login page', function () {
    $this->get(route('admin.joinings.index'))
        ->assertRedirect(route('admin.login'));
});

it('renders the admin login page', function () {
    $this->get(route('admin.login'))
        ->assertOk()
        ->assertSee('Admin sign in');
});

it('pre-fills the demo credentials in the local environment', function () {
    app()->detectEnvironment(fn (): string => 'local');

    Livewire::test(Login::class)
        ->assertSet('email', 'admin@nce.test')
        ->assertSet('password', 'password');
});

it('redirects authenticated users away from the login page', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.login'))
        ->assertRedirect(route('admin.joinings.index'));
});

it('authenticates a user with valid credentials', function () {
    $user = User::factory()->create(['password' => 'secret-password']);

    Livewire::test(Login::class)
        ->set('email', $user->email)
        ->set('password', 'secret-password')
        ->call('login')
        ->assertHasNoErrors()
        ->assertRedirect(route('admin.joinings.index'));

    $this->assertAuthenticatedAs($user);
});

it('rejects invalid credentials', function () {
    $user = User::factory()->create(['password' => 'secret-password']);

    Livewire::test(Login::class)
        ->set('email', $user->email)
        ->set('password', 'wrong-password')
        ->call('login')
        ->assertHasErrors('email');

    $this->assertGuest();
});

it('logs the user out', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('admin.logout'))
        ->assertRedirect(route('admin.login'));

    $this->assertGuest();
});
