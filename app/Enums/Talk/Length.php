<?php

namespace App\Enums\Talk;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Support\Facades\Lang;

enum Length: string implements HasLabel
{
    case Lightning = 'lightning';
    case Normal = 'normal';
    case Keynote = 'keynote';

    public function getLabel(): ?string
    {
        return Lang::has("options.talk.length.{$this->value}")
            ? __("options.talk.length.{$this->value}")
            : $this->name;
    }
}
