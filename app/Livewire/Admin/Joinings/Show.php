<?php

namespace App\Livewire\Admin\Joinings;

use App\Enums\JoiningStatus;
use App\Models\Joining;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Show extends Component
{
    public Joining $joining;

    public string $status = '';

    public ?string $feedback = null;

    public function mount(Joining $joining): void
    {
        $this->joining = $joining;
        $this->status = $joining->status->value;
    }

    public function updateStatus(): void
    {
        $validated = $this->validate([
            'status' => ['required', Rule::enum(JoiningStatus::class)],
        ]);

        $this->joining->update($validated);

        $this->status = $this->joining->status->value;
        $this->feedback = 'Status updated.';
    }

    public function delete(): void
    {
        $this->joining->delete();

        session()->flash('status', 'Entry deleted.');

        $this->redirectRoute('admin.joinings.index');
    }

    public function render(): View
    {
        return view('livewire.admin.joinings.show', [
            'hasScreenshot' => $this->hasScreenshot(),
        ])->layout('layouts.admin')->title('Join entry #'.$this->joining->id);
    }

    private function hasScreenshot(): bool
    {
        return $this->joining->payment_screenshot !== null
            && Storage::disk('public')->exists($this->joining->payment_screenshot);
    }
}
