<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function beforeCreate(): void
    {   
        $user = auth()->user();

        if (!$user->hasAnyRole((int) $this->data['roles'][0]) || !$user->roles[0]->hasPermission('Insert User')) {
            Notification::make()
                ->warning()
                ->title('You don\'t have the permission!')
                ->body('Please contact administrator.')
                ->persistent()
                ->send(); 
     
            $this->halt();
        }
    }
    
}
