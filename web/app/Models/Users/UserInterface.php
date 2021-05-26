<?php

namespace App\Models\Users;

interface UserInterface
{
    /**
     * @return bool
     */
    public function isAdmin(): bool;

    /**
     * @return bool
     */
    public function isGuest(): bool;
}
