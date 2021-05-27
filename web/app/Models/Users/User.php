<?php

namespace App\Models\Users;

use App\Models\Department;
use App\Models\Position;
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

    /**
     * @var Position|null
     */
    private ?Position $position;

    /**
     * @var Department|null
     */
    private ?Department $department;

    public function __construct(
        ?int $id,
        string $login,
        string $password,
        Role $role,
        ?Position $position = null,
        ?Department $department = null
    ) {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->role = $role;
        $this->position = $position;
        $this->department = $department;
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
     * @return Position|null
     */
    public function getPosition(): ?Position
    {
        return $this->position;
    }

    /**
     * @return Department|null
     */
    public function getDepartment(): ?Department
    {
        return $this->department;
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
     * @param Position $position
     *
     * @return void
     */
    public function setPosition(Position $position): void
    {
        $this->position = $position;
    }

    /**
     * @param Department $department
     *
     * @return void
     */
    public function setDepartment(Department $department): void
    {
        $this->department = $department;
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
