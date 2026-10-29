<?php

use App\Enums\JoiningStatus;
use App\Livewire\JoiningForm;
use App\Models\Joining;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('creates a join entry from the basic details', function () {
    Livewire::test(JoiningForm::class)
        ->set('name', 'Asha Verma')
        ->set('jnv_name', 'JNV Varanasi')
        ->set('business_name', 'Comestro')
        ->set('phone_number', '9876543210')
        ->call('nextStep')
        ->assertHasNoErrors()
        ->assertSet('step', 2)
        ->assertSet('business_name_city', 'Comestro');

    $joining = Joining::firstOrFail();

    expect($joining->name)->toBe('Asha Verma')
        ->and($joining->personal_number)->toBe('9876543210')
        ->and($joining->email)->toBeNull()
        ->and($joining->jnv_name)->toBe('JNV Varanasi')
        ->and($joining->business_name_city)->toBe('Comestro')
        ->and($joining->status)->toBe(JoiningStatus::PendingPayment);
});

it('moves to the details step after payment proof', function () {
    $joining = Joining::factory()->create();

    Livewire::test(JoiningForm::class)
        ->set('joiningId', $joining->id)
        ->set('step', 2)
        ->set('upi_transaction_id', 'UPI123456')
        ->call('submitPaymentProof')
        ->assertHasNoErrors()
        ->assertSet('step', 3);

    expect($joining->fresh()->status)->toBe(JoiningStatus::PaymentSubmitted)
        ->and($joining->fresh()->upi_transaction_id)->toBe('UPI123456');
});

it('requires a payment screenshot or transaction id', function () {
    $joining = Joining::factory()->create();

    Livewire::test(JoiningForm::class)
        ->set('joiningId', $joining->id)
        ->set('step', 2)
        ->call('submitPaymentProof')
        ->assertHasErrors(['payment_screenshot', 'upi_transaction_id'])
        ->assertSet('step', 2);
});

it('saves the additional details after payment', function () {
    $joining = Joining::factory()->create();

    Livewire::test(JoiningForm::class)
        ->set('joiningId', $joining->id)
        ->set('step', 3)
        ->set('email', 'asha@example.com')
        ->set('batch', '2005')
        ->set('official_contact_number', '9876500000')
        ->set('address_city', 'Varanasi')
        ->set('business_name_city', 'Comestro, Varanasi')
        ->set('business_category', 'IT & Software')
        ->set('website', 'https://example.com')
        ->set('products_services', 'Software development')
        ->set('willing_volunteer', true)
        ->set('willing_sponsor', false)
        ->call('submitDetails')
        ->assertHasNoErrors()
        ->assertSet('step', 4);

    $joining->refresh();

    expect($joining->email)->toBe('asha@example.com')
        ->and($joining->batch)->toBe('2005')
        ->and($joining->official_contact_number)->toBe('9876500000')
        ->and($joining->address_city)->toBe('Varanasi')
        ->and($joining->business_name_city)->toBe('Comestro, Varanasi')
        ->and($joining->business_category)->toBe('IT & Software')
        ->and($joining->website)->toBe('https://example.com')
        ->and($joining->products_services)->toBe('Software development')
        ->and($joining->willing_volunteer)->toBeTrue()
        ->and($joining->willing_sponsor)->toBeFalse();
});

it('validates the required additional details', function () {
    $joining = Joining::factory()->create();

    Livewire::test(JoiningForm::class)
        ->set('joiningId', $joining->id)
        ->set('step', 3)
        ->call('submitDetails')
        ->assertHasErrors(['email', 'business_name_city', 'business_category', 'products_services'])
        ->assertSet('step', 3);
});

it('allows optional details to be left blank', function () {
    $joining = Joining::factory()->create();

    Livewire::test(JoiningForm::class)
        ->set('joiningId', $joining->id)
        ->set('step', 3)
        ->set('email', 'asha@example.com')
        ->set('business_name_city', 'Comestro, Varanasi')
        ->set('business_category', 'IT & Software')
        ->set('products_services', 'Software development')
        ->call('submitDetails')
        ->assertHasNoErrors()
        ->assertSet('step', 4);

    $joining->refresh();

    expect($joining->batch)->toBeNull()
        ->and($joining->official_contact_number)->toBeNull()
        ->and($joining->address_city)->toBeNull()
        ->and($joining->website)->toBeNull();
});
