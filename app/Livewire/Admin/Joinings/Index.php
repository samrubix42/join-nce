<?php

namespace App\Livewire\Admin\Joinings;

use App\Enums\JoiningStatus;
use App\Models\Joining;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public string $status = '';

    public ?string $feedback = null;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->reset('search', 'status');
        $this->resetPage();
    }

    public function updateStatus(int $joiningId, string $status): void
    {
        $validated = Validator::make(
            ['status' => $status],
            ['status' => ['required', Rule::enum(JoiningStatus::class)]],
        )->validate();

        Joining::findOrFail($joiningId)->update($validated);

        $this->feedback = 'Status updated.';
    }

    public function delete(int $joiningId): void
    {
        Joining::findOrFail($joiningId)->delete();

        $this->resetPage();
        $this->feedback = 'Entry deleted.';
    }

    public function render(): View
    {
        $joinings = Joining::query()
            ->search($this->search)
            ->when(
                JoiningStatus::tryFrom($this->status),
                fn (Builder $query, JoiningStatus $status) => $query->where('status', $status->value),
            )
            ->latest('id')
            ->paginate(10);

        $statusCounts = Joining::query()
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('livewire.admin.joinings.index', [
            'joinings' => $joinings,
            'statusCounts' => $statusCounts,
            'total' => $statusCounts->sum(),
        ])->layout('layouts.admin')->title('Join entries');
    }
}
