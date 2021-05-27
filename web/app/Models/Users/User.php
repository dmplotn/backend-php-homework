<?php

namespace App\Models\Users;

use App\Models\Role;

class User implements UserInterface
{
    /**
     * @var int|null
     */
    private ?int $id = null;

    /**
     * @var string
     */
    private string $login;

    /**
     * @var string
     */
    private string $password;

    /**
     * @var Role
     */
    private Role $role;

    public function __construct(
        ?int $id,
        string $login,
        string $password,
        Role $role
    ) {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->role = $role;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @param string $login
     *
     * @return void
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @param string $password
     *
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param Role $role
     *
     * @return void
     */
    public function setRole(Role $role): void
    {
        $this->role = $role;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role->getName() === 'admin';
    }

    /**
     * @return bool
     */
    public function isGuest(): bool
    {
        return false;
    }
}
