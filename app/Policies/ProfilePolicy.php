<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Profile;

class ProfilePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(Admin $admin, Profile $profile): bool
    {
        return true;
    }

    public function create(Admin $admin, Profile $profile): bool
    {
        return $admin->exists();
    }

    public function update(Admin $admin, Profile $profile): bool
    {
        return $admin->exists();
    }

    public function delete(Admin $admin, Profile $profile): bool
    {
        return $admin->exists();
    }
}
