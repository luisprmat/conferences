<?php

namespace App\Filament\Resources;

use App\Enums\Speaker\Qualification;
use App\Enums\Talk\Status;
use App\Filament\Resources\SpeakerResource\Pages;
use App\Models\Speaker;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SpeakerResource extends Resource
{
    protected static ?string $model = Speaker::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('speaker');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Speaker::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('xcom_handle')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make(__('Personal Information'))
                    ->columns(3)
                    ->schema([
                        Infolists\Components\ImageEntry::make('avatar')
                            ->circular(),
                        Infolists\Components\Group::make()
                            ->columns(2)
                            ->columnSpan(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('name'),
                                Infolists\Components\TextEntry::make('email'),
                                Infolists\Components\TextEntry::make('xcom_handle')
                                    ->prefix('@')
                                    ->url(fn ($record) => 'https://x.com/'.$record->xcom_handle),
                                Infolists\Components\TextEntry::make(__('options.speaker.has_spoken.label'))
                                    ->getStateUsing(function ($record) {
                                        return $record->talks()->where('status', Status::Approved)->count() > 0
                                            ? __('options.speaker.has_spoken.yes')
                                            : __('options.speaker.has_spoken.no');
                                    })
                                    ->badge()
                                    ->color(function ($state) {
                                        if ($state === __('options.speaker.has_spoken.yes')) {
                                            return 'success';
                                        }

                                        return 'primary';
                                    }),
                            ]),
                    ]),
                Infolists\Components\Section::make(__('Other Information'))
                    ->schema([
                        Infolists\Components\TextEntry::make('bio')
                            ->extraAttributes(['class' => 'prose dark:prose-invert'])
                            // ->prose()
                            ->html(),
                        Infolists\Components\TextEntry::make('qualifications')
                            ->formatStateUsing(fn (string $state) => Qualification::from($state))
                            ->listWithLineBreaks()
                            ->bulleted(),
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSpeakers::route('/'),
            'create' => Pages\CreateSpeaker::route('/create'),
            'view' => Pages\ViewSpeaker::route('/{record}'),
        ];
    }
}
