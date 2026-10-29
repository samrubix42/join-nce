<?php

namespace App\Livewire;

use App\Models\Joining;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class JoiningForm extends Component
{
    use WithFileUploads;

    private const string UPI_PAYMENT_URL = 'upi://pay?pa=mab.037213039820027%40axisbank&cu=INR&am=3000.00&tn=Varanasi+Meet';

    public int $step = 1;

    public ?int $joiningId = null;

    public string $name = '';

    public string $jnv_name = '';

    public string $business_name = '';

    public string $phone_number = '';

    public string $personal_number = '';

    public string $email = '';

    public string $batch = '';

    public string $official_contact_number = '';

    public string $address_city = '';

    public string $business_name_city = '';

    public string $business_category = '';

    public string $website = '';

    public string $products_services = '';

    public bool $willing_volunteer = false;

    public bool $willing_sponsor = false;

    public $payment_screenshot = null;

    public string $upi_transaction_id = '';

    public function nextStep(): void
    {
        if ($this->step === 1) {
            $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'jnv_name' => ['required', 'string', 'max:255'],
                'business_name' => ['required', 'string', 'max:255'],
                'phone_number' => ['required', 'string', 'max:255'],
            ]);

            $joining = Joining::create([
                'name' => $this->name,
                'personal_number' => $this->phone_number,
                'jnv_name' => $this->jnv_name,
                'business_name_city' => $this->business_name,
                'status' => 'pending_payment',
            ]);

            $this->business_name_city = $this->business_name;
            $this->joiningId = $joining->id;
            $this->step = 2;

            $this->js('window.location.href = '.json_encode(self::UPI_PAYMENT_URL).';');

            return;
        }
    }

    public function submitPaymentProof(): void
    {
        if (! $this->joiningId) {
            return;
        }

        $this->validate([
            'upi_transaction_id' => ['nullable', 'string', 'max:255'],
            'payment_screenshot' => ['nullable', 'image', 'max:5120'],
        ]);

        if (! $this->payment_screenshot && ! $this->upi_transaction_id) {
            $this->addError('payment_screenshot', 'Please upload a screenshot or enter a UPI transaction ID.');
            $this->addError('upi_transaction_id', 'Please upload a screenshot or enter a UPI transaction ID.');

            return;
        }

        $screenshotPath = null;
        if ($this->payment_screenshot) {
            $screenshotPath = $this->payment_screenshot->store('payment-screenshots', 'public');
        }

        $joining = Joining::findOrFail($this->joiningId);
        $joining->update([
            'upi_transaction_id' => $this->upi_transaction_id ?: null,
            'payment_screenshot' => $screenshotPath,
            'status' => 'payment_submitted',
        ]);

        $this->step = 3;
    }

    public function submitDetails(): void
    {
        if (! $this->joiningId) {
            return;
        }

        $validated = $this->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'batch' => ['nullable', 'string', 'max:255'],
            'official_contact_number' => ['nullable', 'string', 'max:255'],
            'address_city' => ['nullable', 'string', 'max:255'],
            'business_name_city' => ['required', 'string', 'max:255'],
            'business_category' => ['required', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'products_services' => ['required', 'string', 'max:2000'],
            'willing_volunteer' => ['boolean'],
            'willing_sponsor' => ['boolean'],
        ]);

        $validated['batch'] = $validated['batch'] ?: null;
        $validated['official_contact_number'] = $validated['official_contact_number'] ?: null;
        $validated['address_city'] = $validated['address_city'] ?: null;
        $validated['website'] = $validated['website'] ?: null;

        Joining::findOrFail($this->joiningId)->update($validated);

        $this->step = 4;
    }

    public function render()
    {
        return view('livewire.joining-form')->layout('components.layouts.app');
    }
}
