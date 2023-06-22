<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            DeleteAction::make()
                ->before(function(DeleteAction $action){
                    $this->checkUserRolePermission('Delete User') ?? $action->halt();
                }),
        ];
    }

    protected function beforeSave(): void
    {   
        $this->checkUserRolePermission('Update User') ?? $this->halt();
    }

    protected function checkUserRolePermission( $permission ): bool
    {
        $user = auth()->user();

        if (!$user->hasAnyRole((int) $this->data['roles'][0]) || $user->roles[0]->hasPermission($permission)) {
            Notification::make()
                ->warning()
                ->title('You don\'t have the permission!')
                ->body('Please contact administrator.')
                ->persistent()
                ->send(); 
     
            return true;
        }
        
        return false;
    }
}
