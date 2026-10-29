<?php

namespace App\Models;

use App\Enums\JoiningStatus;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Joining extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'personal_number',
        'email',
        'jnv_name',
        'batch',
        'official_contact_number',
        'address_city',
        'business_name_city',
        'business_category',
        'website',
        'products_services',
        'willing_volunteer',
        'willing_sponsor',
        'status',
        'upi_transaction_id',
        'payment_screenshot',
    ];

    protected function casts(): array
    {
        return [
            'willing_volunteer' => 'boolean',
            'willing_sponsor' => 'boolean',
            'status' => JoiningStatus::class,
        ];
    }

    #[Scope]
    protected function search(Builder $query, ?string $search): void
    {
        $search = trim((string) $search);

        if ($search === '') {
            return;
        }

        $query->whereAny([
            'name',
            'email',
            'personal_number',
            'official_contact_number',
            'jnv_name',
            'business_name_city',
            'business_category',
        ], 'like', "%{$search}%");
    }

    protected static function booted(): void
    {
        static::deleted(function (Joining $joining): void {
            if ($joining->payment_screenshot) {
                Storage::disk('public')->delete($joining->payment_screenshot);
            }
        });
    }
}
