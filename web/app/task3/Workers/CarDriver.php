<?php

class CarDriver extends Worker
{
    protected $drivingLicenseType;

    public function __construct(
        string $name,
        int $age,
        float $salary,
        int $experienceInYears,
        string $drivingLicenseType
    ) {
        parent::__construct($name, $age, $salary, $experienceInYears);
        $this->drivingLicenseType = $drivingLicenseType;
    }

    public function getDrivingLicenseType(): string
    {
        return $this->drivingLicenseType;
    }

    public function setDrivingLicenseType(string $drivingLicenseType): void
    {
        $this->drivingLicenseType = $drivingLicenseType;
    }
}
