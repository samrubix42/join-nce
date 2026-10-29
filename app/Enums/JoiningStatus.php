<?php

namespace App\Enums;

enum JoiningStatus: string
{
    case PendingPayment = 'pending_payment';
    case PaymentSubmitted = 'payment_submitted';
    case Approved = 'approved';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::PendingPayment => 'Pending payment',
            self::PaymentSubmitted => 'Payment submitted',
            self::Approved => 'Approved',
            self::Rejected => 'Rejected',
        };
    }

    public function badgeClasses(): string
    {
        return match ($this) {
            self::PendingPayment => 'bg-amber-50 text-amber-700 ring-amber-600/20',
            self::PaymentSubmitted => 'bg-sky-50 text-sky-700 ring-sky-600/20',
            self::Approved => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
            self::Rejected => 'bg-rose-50 text-rose-700 ring-rose-600/20',
        };
    }

    public function dotClasses(): string
    {
        return match ($this) {
            self::PendingPayment => 'bg-amber-500',
            self::PaymentSubmitted => 'bg-sky-500',
            self::Approved => 'bg-emerald-500',
            self::Rejected => 'bg-rose-500',
        };
    }
}
