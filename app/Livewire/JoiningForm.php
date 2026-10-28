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

    public ?string $willing_volunteer = null;

    public ?string $willing_sponsor = null;

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
                'personal_number' => $this->phone_number,
                'email' => $this->email ?: $this->phone_number.'@temp.com',
                'jnv_name' => $this->jnv_name,
                'batch' => $this->batch ?: 'N/A',
                'official_contact_number' => $this->official_contact_number ?: $this->phone_number,
                'address_city' => $this->address_city ?: 'N/A',
                'business_name_city' => $this->business_name ?: $this->business_name_city ?: 'N/A',
                'business_category' => $this->business_category ?: 'N/A',
                'website' => $this->website ?: null,
                'products_services' => $this->products_services ?: 'N/A',
                'willing_volunteer' => false,
                'willing_sponsor' => false,
                'status' => 'pending_payment',
            ]);

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

    public function render()
    {
        return view('livewire.joining-form')->layout('components.layouts.app');
    }
}
