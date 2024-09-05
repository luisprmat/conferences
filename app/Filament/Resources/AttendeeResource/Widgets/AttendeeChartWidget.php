<?php

namespace App\Filament\Resources\AttendeeResource\Widgets;

use App\Filament\Resources\AttendeeResource\Pages\ListAttendees;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class AttendeeChartWidget extends ChartWidget
{
    use InteractsWithPageTable;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $pollingInterval = null;

    protected static ?string $maxHeight = '200px';

    public ?string $filter = '3months';

    public function getHeading(): string
    {
        return __('Attendee Signups');
    }

    protected function getFilters(): ?array
    {
        return [
            'week' => __('options.widgets.filters.week'),
            'month' => __('options.widgets.filters.month'),
            '3months' => __('options.widgets.filters.last_months', ['months' => 3]),
        ];
    }

    protected function getTablePage(): string
    {
        return ListAttendees::class;
    }

    protected function getData(): array
    {
        $filter = $this->filter;

        $query = $this->getPageTableQuery();
        $query->getQuery()->orders = [];

        $data = match ($filter) {
            'week' => Trend::query($query)
                ->between(
                    start: now()->subWeek(),
                    end: now(),
                )
                ->perDay()
                ->count(),
            'month' => Trend::query($query)
                ->between(
                    start: now()->subMonth(),
                    end: now(),
                )
                ->perDay()
                ->count(),
            '3months' => Trend::query($query)
                ->between(
                    start: now()->subMonths(3),
                    end: now(),
                )
                ->perMonth()
                ->count(),
        };

        return [
            'datasets' => [
                [
                    'label' => __('Signups'),
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
