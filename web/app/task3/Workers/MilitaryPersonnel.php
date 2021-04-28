<?php

class MilitaryPersonnel extends Worker
{
    protected $rank;
    protected $branch;

    public function __construct(
        string $name,
        int $age,
        float $salary,
        int $experienceInYears,
        string $rank,
        string $branch
    ) {
        parent::__construct($name, $age, $salary, $experienceInYears);
        $this->rank = $rank;
        $this->branch = $branch;
    }

    public function getRank(): string
    {
        return $this->rank;
    }

    public function setRank(string $rank): void
    {
        $this->rank = $rank;
    }

    public function getBranch(): string
    {
        return $this->branch;
    }

    public function setBranch(string $branch): void
    {
        $this->branch = $branch;
    }
}
