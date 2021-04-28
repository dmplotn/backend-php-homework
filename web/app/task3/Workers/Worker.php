<?php

abstract class Worker
{
    protected $name;
    protected $age;
    protected $salary;
    protected $experienceInYears;

    public function __construct(
        string $name,
        int $age,
        float $salary,
        int $experienceInYears
    ) {
        $this->name = $name;
        $this->age = $age;
        $this->salary = $salary;
        $this->experienceInYears = $experienceInYears;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }

    public function getExperienceInYears(): int
    {
        return $this->experienceInYears;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function setSalary(float $salary): void
    {
        $this->salary = $salary;
    }

    public function setExperienceInYears(int $experienceInYears): void
    {
        $this->experienceInYears = $experienceInYears;
    }

    public static function getPropertyNames(): array
    {
        return array_keys(get_class_vars(static::class));
    }
}
