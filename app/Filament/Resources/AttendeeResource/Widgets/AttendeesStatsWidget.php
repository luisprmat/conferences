<?php

namespace App\Filament\Resources\AttendeeResource\Widgets;

use App\Filament\Resources\AttendeeResource\Pages\ListAttendees;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AttendeesStatsWidget extends BaseWidget
{
    use InteractsWithPageTable;

    protected function getColumns(): int
    {
        return 2;
    }

    protected function getTablePage(): string
    {
        return ListAttendees::class;
    }

    protected function getStats(): array
    {
        return [
            Stat::make(__('Attendees Count'), $this->getPageTableQuery()->count())
                ->description(__('Total number of attendees'))
                ->descriptionIcon('heroicon-o-user-group')
                ->color('success')
                ->chart([4, 3, 1, 2, 5]),
            Stat::make(__('Total Revenue'), $this->getPageTableQuery()->sum('ticket_cost')),
        ];
    }
}
