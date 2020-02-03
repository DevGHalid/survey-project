<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\User;
use App\Models\Sheet;

class SheetPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {

    }
    
    /**
    * @param  User  $user
    * @param  Sheet  $sheet
    * @return bool
    */
    public function update(User $user, Sheet $sheet): bool
    {
        return $user->id === $sheet->user_id;
    }
}
