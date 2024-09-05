<?php

namespace App\Filament\Resources\AttendeeResource\Widgets;

use App\Models\Attendee;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class AttendeeChartWidget extends ChartWidget
{
    protected int|string|array $columnSpan = 'full';

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

    protected function getData(): array
    {
        $filter = $this->filter;

        $data = match ($filter) {
            'week' => Trend::model(Attendee::class)
                ->between(
                    start: now()->subWeek(),
                    end: now(),
                )
                ->perDay()
                ->count(),
            'month' => Trend::model(Attendee::class)
                ->between(
                    start: now()->subMonth(),
                    end: now(),
                )
                ->perDay()
                ->count(),
            '3months' => Trend::model(Attendee::class)
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
