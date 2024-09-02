<?php

namespace App\Enums\Talk;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Support\Facades\Lang;

enum Status: string implements HasColor, HasLabel
{
    case Submitted = 'submitted';
    case Approved = 'approved';
    case Rejected = 'rejected';

    public function getLabel(): ?string
    {
        return Lang::has("options.talk.status.{$this->value}")
            ? __("options.talk.status.{$this->value}")
            : $this->name;
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Submitted => 'primary',
            self::Approved => 'success',
            self::Rejected => 'danger',
        };
    }
}
