<?php

namespace App\Filament\Resources\AttendeeResource\Widgets;

use App\Models\Attendee;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AttendeesStatsWidget extends BaseWidget
{
    protected function getColumns(): int
    {
        return 2;
    }

    protected function getStats(): array
    {
        return [
            Stat::make(__('Attendees Count'), Attendee::count())
                ->description(__('Total number of attendees'))
                ->descriptionIcon('heroicon-o-user-group')
                ->color('success')
                ->chart([4, 3, 1, 2, 5]),
            Stat::make(__('Total Revenue'), Attendee::sum('ticket_cost')),
        ];
    }
}
