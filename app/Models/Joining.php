<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joining extends Model
{
    use HasFactory;

    protected $fillable = [
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
        ];
    }
}
