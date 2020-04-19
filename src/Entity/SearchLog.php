<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SearchLogRepository")
 */
class SearchLog
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\VehicleType")
     */
    private $vehicle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Make")
     */
    private $make;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberModels;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $requestTime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ip;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $userAgent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVehicle(): ?VehicleType
    {
        return $this->vehicle;
    }

    public function setVehicle(?VehicleType $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    public function getMake(): ?Make
    {
        return $this->make;
    }

    public function setMake(?Make $make): self
    {
        $this->make = $make;

        return $this;
    }

    public function getNumberModels(): ?int
    {
        return $this->numberModels;
    }

    public function setNumberModels(int $numberModels): self
    {
        $this->numberModels = $numberModels;

        return $this;
    }

    public function getRequestTime(): ?string
    {
        return $this->requestTime;
    }

    public function setRequestTime(string $requestTime): self
    {
        $this->requestTime = $requestTime;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    public function setUserAgent(string $userAgent): self
    {
        $this->userAgent = $userAgent;

        return $this;
    }
}