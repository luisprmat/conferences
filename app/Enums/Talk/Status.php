<?php

namespace App\Enums\Talk;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Support\Facades\Lang;

enum Status: string implements HasLabel
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
}
