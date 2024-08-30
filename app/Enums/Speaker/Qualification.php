<?php

namespace App\Enums\Speaker;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

enum Qualification: string implements HasLabel
{
    case BusinessLeader = 'business-leader';
    case Charisma = 'charisma';
    case FirstTime = 'first-time';
    case HometownHero = 'hometown-hero';
    case humanitarian = 'humanitarian';
    case LaracastsContributor = 'laracasts-contributor';
    case TwitterInfluencer = 'twitter-influencer';
    case YoutubeInfluencer = 'youtube-influencer';
    case OpenSource = 'open-source';
    case UniquePerspective = 'unique-perspective';

    public function getLabel(): ?string
    {
        $translateKey = Str::snake($this->name);

        return Lang::has("options.speaker.qualifications.{$translateKey}")
            ? __("options.speaker.qualifications.{$translateKey}")
            : Str::of($this->name)->snake(' ')->title();
    }
}
