<?php

use App\Enums\JoiningStatus;
use App\Livewire\Admin\Joinings\Index;
use App\Livewire\Admin\Joinings\Show;
use App\Models\Joining;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create();
});

it('redirects guests to the admin login page', function () {
    $this->get(route('admin.joinings.index'))
        ->assertRedirect(route('admin.login'));
});

it('lists join entries', function () {
    $joinings = Joining::factory()->count(3)->create();

    $this->actingAs($this->admin)
        ->get(route('admin.joinings.index'))
        ->assertOk()
        ->assertSee($joinings->first()->name)
        ->assertSee($joinings->last()->name);
});

it('allows multiple entries with the same email address', function () {
    Joining::factory()->create(['email' => 'shared@example.com']);
    Joining::factory()->create(['email' => 'shared@example.com']);

    expect(Joining::where('email', 'shared@example.com')->count())->toBe(2);
});

it('searches join entries', function () {
    $matching = Joining::factory()->create(['name' => 'Asha Verma']);
    $other = Joining::factory()->create(['name' => 'Ravi Kumar']);

    $this->actingAs($this->admin);

    Livewire::test(Index::class)
        ->set('search', 'Asha')
        ->assertSee($matching->name)
        ->assertDontSee($other->name);
});

it('filters join entries by status', function () {
    $approved = Joining::factory()->approved()->create();
    $pending = Joining::factory()->create();

    $this->actingAs($this->admin);

    Livewire::test(Index::class)
        ->set('status', JoiningStatus::Approved->value)
        ->assertSee($approved->email)
        ->assertDontSee($pending->email);
});

it('clears the search and status filters', function () {
    $joining = Joining::factory()->create();

    $this->actingAs($this->admin);

    Livewire::test(Index::class)
        ->set('search', 'something')
        ->set('status', JoiningStatus::Approved->value)
        ->call('clearFilters')
        ->assertSet('search', '')
        ->assertSet('status', '')
        ->assertSee($joining->email);
});

it('updates the status of a join entry from the list', function () {
    $joining = Joining::factory()->create();

    $this->actingAs($this->admin);

    Livewire::test(Index::class)
        ->call('updateStatus', $joining->id, JoiningStatus::Approved->value)
        ->assertHasNoErrors();

    expect($joining->fresh()->status)->toBe(JoiningStatus::Approved);
});

it('rejects an invalid status', function () {
    $joining = Joining::factory()->create();

    $this->actingAs($this->admin);

    Livewire::test(Index::class)
        ->call('updateStatus', $joining->id, 'not-a-status')
        ->assertHasErrors('status');

    expect($joining->fresh()->status)->toBe(JoiningStatus::PendingPayment);
});

it('deletes a join entry from the list', function () {
    $joining = Joining::factory()->create();

    $this->actingAs($this->admin);

    Livewire::test(Index::class)
        ->call('delete', $joining->id);

    $this->assertModelMissing($joining);
});

it('deletes the payment screenshot when a join entry is deleted', function () {
    Storage::fake('public');
    Storage::disk('public')->put('payment-screenshots/proof.jpg', 'image');

    $joining = Joining::factory()->create([
        'payment_screenshot' => 'payment-screenshots/proof.jpg',
    ]);

    $joining->delete();

    Storage::disk('public')->assertMissing('payment-screenshots/proof.jpg');
});

it('shows a join entry', function () {
    $joining = Joining::factory()->create();

    $this->actingAs($this->admin)
        ->get(route('admin.joinings.show', $joining))
        ->assertOk()
        ->assertSee($joining->name)
        ->assertSee($joining->email)
        ->assertSee($joining->business_name_city);
});

it('updates the status of a join entry from the detail page', function () {
    $joining = Joining::factory()->create();

    $this->actingAs($this->admin);

    Livewire::test(Show::class, ['joining' => $joining])
        ->assertSet('status', JoiningStatus::PendingPayment->value)
        ->set('status', JoiningStatus::PaymentSubmitted->value)
        ->call('updateStatus')
        ->assertHasNoErrors();

    expect($joining->fresh()->status)->toBe(JoiningStatus::PaymentSubmitted);
});

it('deletes a join entry from the detail page', function () {
    $joining = Joining::factory()->create();

    $this->actingAs($this->admin);

    Livewire::test(Show::class, ['joining' => $joining])
        ->call('delete')
        ->assertRedirect(route('admin.joinings.index'));

    $this->assertModelMissing($joining);
});

it('streams the payment screenshot to an authenticated admin', function () {
    Storage::fake('public');
    Storage::disk('public')->put('payment-screenshots/proof.jpg', 'image');

    $joining = Joining::factory()->create([
        'payment_screenshot' => 'payment-screenshots/proof.jpg',
    ]);

    $this->actingAs($this->admin)
        ->get(route('admin.joinings.screenshot', $joining))
        ->assertOk();
});

it('returns not found when the payment screenshot is missing', function () {
    Storage::fake('public');

    $joining = Joining::factory()->create();

    $this->actingAs($this->admin)
        ->get(route('admin.joinings.screenshot', $joining))
        ->assertNotFound();
});

it('protects payment screenshots from guests', function () {
    $joining = Joining::factory()->create();

    $this->get(route('admin.joinings.screenshot', $joining))
        ->assertRedirect(route('admin.login'));
});
