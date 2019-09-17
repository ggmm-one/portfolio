<?php

class Timestamps extends Faker\Provider\Base
{
    private $lastCreatedIssued = null;
    private $lastUpdatedIssued = null;
    private $lastSequentialDateIssued = null;

    public function createdAt($max = '-30 days')
    {
        $this->lastCreatedIssued = $this->generator->dateTime($max);
        return $this->lastCreatedIssued;
    }

    public function updatedAt($max = 'now')
    {
        $this->lastUpdatedIssued = $this->generator->dateTimeBetween($this->lastCreatedIssued, $max);
        return $this->lastUpdatedIssued;
    }

    public function deletedAt($max = 'now')
    {
        return $this->generator->dateTimeBetween($this->lastUpdatedIssued, $max);
    }

    public function sequentialDate($max = '+10 years')
    {
        if ($this->lastSequentialDateIssued && $this->lastSequentialDateIssued->getTimestamp() > strtotime('+5 years')) $this->lastSequentialDateIssued = null;
        $this->lastSequentialDateIssued = $this->generator->dateTimeBetween($this->lastSequentialDateIssued, $max);
        return $this->lastSequentialDateIssued;
    }

    public static function appendTimestamps($faker, $data)
    {
        return array_merge($data, [
            'created_at' => $faker->createdAt,
            'updated_at' => $faker->updatedAt,
        ]);
    }
}
