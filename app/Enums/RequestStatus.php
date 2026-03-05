<?php

namespace App\Enums;

enum RequestStatus: string
{
    case PENDING  = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'معلق',
            self::APPROVED => 'موافق عليه',
            self::REJECTED => 'مرفوض',
        };
    }


    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::APPROVED => 'success',
            self::REJECTED => 'danger',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::PENDING => 'fa-hourglass-half',
            self::APPROVED => 'fa-check-circle',
            self::REJECTED => 'fa-times-circle',
        };
    }
}
