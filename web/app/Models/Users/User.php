<?php

namespace App\Models\Users;

class User implements UserInterface
{
    public const ADMIN_ROLE = 1;

    public const USER_ROLE = 2;

    private const AVAILABLE_ROLES = [
        self::ADMIN_ROLE,
        self::USER_ROLE
    ];

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
     * @var int
     */
    private int $roleId;

    /**
     * @param int|null $id
     * @param string $login
     * @param string $password
     * @param int $roleId
     */
    public function __construct(?int $id, string $login, string $password, int $roleId)
    {
        if ($id !== null && $id <= 0) {
            throw new \DomainException("Id is negative: {$id}");
        }

        if ($login === '') {
            throw new \DomainException("Login is empty");
        }

        if (!in_array($roleId, self::AVAILABLE_ROLES)) {
            throw new \DomainException("Unknown role: {$roleId}");
        }

        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->roleId = $roleId;
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
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->roleId;
    }

    /**
     * @param string $login
     *
     * @return void
     */
    public function setLogin(string $login): void
    {
        if ($login === '') {
            throw new \DomainException("Login is empty");
        }

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
     * @param int $roleId
     *
     * @return void
     */
    public function setRole(int $roleId): void
    {
        if (!in_array($roleId, self::AVAILABLE_ROLES)) {
            throw new \DomainException("Unknown role: {$roleId}");
        }

        $this->role = $roleId;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->roleId === self::ADMIN_ROLE;
    }

    public function isGuest(): bool
    {
        return false;
    }
}
