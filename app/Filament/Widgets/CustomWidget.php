<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\AttendeeResource;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;

class CustomWidget extends Widget implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected int|string|array $columnSpan = 'full';

    protected static string $view = 'filament.widgets.custom-widget';

    public function callNotification(): Action
    {
        return Action::make('callNotification')
            ->button()
            ->color('warning')
            ->action(function () {
                Notification::make()
                    ->warning()
                    ->persistent()
                    ->title('You send a notification')
                    ->body('This is a test!')
                    ->actions([
                        Notifications\Actions\Action::make('goToAttendees')
                            ->button()
                            ->url(AttendeeResource::getUrl('index')),
                        Notifications\Actions\Action::make('undo')
                            ->link()
                            ->color('gray')
                            ->action(function () {
                                dd('Hi');
                            }),
                    ])
                    ->send();
            });
    }
}
