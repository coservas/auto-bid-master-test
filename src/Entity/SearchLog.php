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
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $vehicleTypeCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $makeCode;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $numberModels;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?\DateTime $requestTime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $ip;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $userAgent;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getRequestTime(): ?\DateTime
    {
        return $this->requestTime;
    }

    public function setRequestTime(\DateTime $requestTime): self
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

    /**
     * @return mixed
     */
    public function getVehicleTypeCode()
    {
        return $this->vehicleTypeCode;
    }

    /**
     * @param mixed $vehicleTypeCode
     * @return SearchLog
     */
    public function setVehicleTypeCode($vehicleTypeCode)
    {
        $this->vehicleTypeCode = $vehicleTypeCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMakeCode()
    {
        return $this->makeCode;
    }

    /**
     * @param mixed $makeCode
     * @return SearchLog
     */
    public function setMakeCode($makeCode)
    {
        $this->makeCode = $makeCode;
        return $this;
    }
}
