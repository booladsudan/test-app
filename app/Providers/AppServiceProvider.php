<?php

namespace App\Providers;

use Althinect\FilamentSpatieRolesPermissions\Commands\Permission;
use Althinect\FilamentSpatieRolesPermissions\Resources\RoleResource;
use App\Filament\Resources\UserResource;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
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
        Filament::navigation(function (NavigationBuilder $builder): NavigationBuilder {
            return $builder
                ->items([
                    NavigationItem::make('Dashboard')
                        ->icon('heroicon-o-home')
                        ->activeIcon('heroicon-s-home')
                        ->isActiveWhen(fn (): bool => request()->routeIs('filament.pages.dashboard'))
                        ->url(route('filament.pages.dashboard')),
                    ...UserResource::getNavigationItems(),
                ])
                ->groups([
                    NavigationGroup::make('Roles And Permissions')
                        ->items([
                            NavigationItem::make('Roles')
                                ->icon('heroicon-o-users')
                                ->activeIcon('heroicon-s-users')
                                ->isActiveWhen(fn (): bool => request()->routeIs('filament.resources.roles.index'))
                                ->url(route('filament.resources.roles.index'))
                                ->visible(auth()->user()->isSuperAdmin()),
                            NavigationItem::make('Permissions')
                                ->icon('heroicon-o-key')
                                ->activeIcon('heroicon-s-key')
                                ->isActiveWhen(fn (): bool => request()->routeIs('filament.resources.permissions.index'))
                                ->url(route('filament.resources.permissions.index'))
                                ->visible(auth()->user()->isSuperAdmin()),
                        ]),
                ]);
        });
    }
}
