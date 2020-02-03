<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\User;
use App\Models\Form;

class FormPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
    * @param  User  $user
    * @param  Form  $sheet
    * @return bool
    */
    public function create(User $user, Form $form): bool
    {
        return $user->id;
    }

    /**
    * @param  User  $user
    * @param  Form  $form
    * @return mixed
    */
    public function show(User $user, Form $form)
    {
        return $user->id === $form->user_id;
    }
}
