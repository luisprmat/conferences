<?php

namespace App\Providers;

use Filament\Actions\CreateAction;
use Filament\Actions\StaticAction as Action;
use Filament\Forms\Components\Component;
use Filament\Infolists\Components\Component as InfolistComponent;
use Filament\Tables\Columns\Column;
use Filament\Tables\Filters\BaseFilter as Filter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        Component::configureUsing(function (Component $component) {
            $component
                ->translateLabel();
        });

        Column::configureUsing(function (Column $column) {
            $column
                ->translateLabel();
        });

        InfolistComponent::configureUsing(function (InfolistComponent $component) {
            $component
                ->translateLabel();
        });

        Filter::configureUsing(function (Filter $filter) {
            $filter
                ->translateLabel();
        });

        Action::configureUsing(function (Action $action) {
            $action
                ->translateLabel();
        });

        CreateAction::configureUsing(function ($action) {
            return $action
                ->slideOver();
        });
    }
}
