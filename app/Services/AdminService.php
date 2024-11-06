<?php

namespace App\Services;

use App\Models\User;
use App\Models\Admin;

class AdminService
{   
    public function createAdmin(User $user): Admin
    {
        Return Admin::create([
            'user_id' => $user->id,
        ]);
    }  
}