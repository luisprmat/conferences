<?php

namespace App\Filament\Resources\TalkResource\Pages;

use App\Enums\Talk\Status;
use App\Filament\Resources\TalkResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ListTalks extends ListRecords
{
    protected static string $resource = TalkResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(__('options.talk.filter.all')),
            'approved' => Tab::make(__('options.talk.filter.approved'))
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', Status::Approved)),
            'submitted' => Tab::make(__('options.talk.filter.submitted'))
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', Status::Submitted)),
            'rejected' => Tab::make(__('options.talk.filter.rejected'))
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', Status::Rejected)),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
