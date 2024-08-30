<?php

namespace App\Enums\Conference;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Support\Facades\Lang;

enum Status: string implements HasLabel
{
    case Draft = 'draft';
    case Published = 'published';
    case Archived = 'archived';

    public function getLabel(): ?string
    {
        return Lang::has("options.conference.status.{$this->value}")
            ? __("options.conference.status.{$this->value}")
            : $this->name;
    }
}
