<?php

namespace App\Models;

use App\Enums\Conference\Status;
use App\Enums\Region;
use Filament\Forms;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Conference extends Model
{
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'venue_id' => 'integer',
            'region' => Region::class,
            'status' => Status::class,
        ];
    }

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    public function speakers(): BelongsToMany
    {
        return $this->belongsToMany(Speaker::class);
    }

    public function talks(): BelongsToMany
    {
        return $this->belongsToMany(Talk::class);
    }

    public static function getForm(): array
    {
        return [
            Forms\Components\Tabs::make()
                ->columnSpanFull()
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Conference Details')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->columnSpanFull()
                                ->default(__('My conference'))
                                ->required()
                                ->maxLength(60),
                            Forms\Components\MarkdownEditor::make('description')
                                ->columnSpanFull()
                                ->helperText(__('You can use Markdown syntax.'))
                                ->required(),
                            Forms\Components\DateTimePicker::make('start_date')
                                ->native(false)
                                ->required(),
                            Forms\Components\DateTimePicker::make('end_date')
                                ->native(false)
                                ->required(),
                            Forms\Components\Fieldset::make('Status')
                                ->columns(1)
                                ->schema([
                                    Forms\Components\Select::make('status')
                                        ->options(Status::class)
                                        ->required(),
                                    Forms\Components\Toggle::make('is_published')
                                        ->default(false),
                                ]),
                        ]),
                    Forms\Components\Tabs\Tab::make('Location')
                        ->schema([
                            Forms\Components\Select::make('region')
                                ->live()
                                ->enum(Region::class)
                                ->options(Region::class),
                            Forms\Components\Select::make('venue_id')
                                ->searchable()
                                ->preload()
                                ->createOptionForm(Venue::getForm())
                                ->editOptionForm(Venue::getForm())
                                ->relationship('venue', 'name', modifyQueryUsing: function (Builder $query, Forms\Get $get) {
                                    return $query->where('region', $get('region'));
                                }),
                        ]),
                ]),
            Forms\Components\Actions::make([
                Forms\Components\Actions\Action::make('star')
                    ->label(__('Fill with factory data'))
                    ->icon('heroicon-m-star')
                    ->visible(function (string $operation) {
                        if ($operation !== 'create') {
                            return false;
                        }

                        if (! app()->environment('local')) {
                            return false;
                        }

                        return true;
                    })
                    ->action(function ($livewire) {
                        $data = Conference::factory()->make()->toArray();
                        $livewire->form->fill($data);
                    }),
            ]),
            // Forms\Components\CheckboxList::make('speakers')
            //     ->relationship('speakers', 'name')
            //     ->options(
            //         Speaker::pluck('name', 'id')
            //     )
            //     ->required(),
        ];
    }
}
