<?php

namespace App\Models\Users;

class Guest implements UserInterface
{
    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isGuest(): bool
    {
        return true;
    }
}
