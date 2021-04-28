<?php

class MedicalDoctor extends Worker
{
    protected $specialization;

    public function __construct(
        string $name,
        int $age,
        float $salary,
        int $experienceInYears,
        string $specialization
    ) {
        parent::__construct($name, $age, $salary, $experienceInYears);
        $this->drivingLicenseType = $specialization;
    }

    public function getSpecialization(): string
    {
        return $this->specialization;
    }

    public function setSpecialization(string $specialization): void
    {
        $this->specialization = $specialization;
    }
}
