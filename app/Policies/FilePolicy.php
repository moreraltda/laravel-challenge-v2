<?php

namespace App\Policies;

use App\Models\File;
use App\Models\User;

class FilePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user can view the file.
     *
     * @param  User  $user
     * @param  File  $file
     * @return bool
     */
    public function view(User $user, File $file): bool
    {
        return $user->id === $file->owner_id || $file->users->contains($user->id);
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, File $file): bool
    {
        return $user->id === $file->owner_id || $file->users->contains($user->id);
    }

    public function delete(User $user, File $file): bool
    {
        return $user->id === $file->owner_id;
    }
}
