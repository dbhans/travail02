<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TranfersRepository")
 */
class Tranfers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $transfer;

    /**
     * @ORM\Column(type="integer")
     */
    private $payer;

    /**
     * @ORM\Column(type="integer")
     */
    private $payee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransfer(): ?int
    {
        return $this->transfer;
    }

    public function setTransfer(?int $transfer): self
    {
        $this->transfer = $transfer;

        return $this;
    }

    public function getPayer(): ?int
    {
        return $this->payer;
    }

    public function setPayer(int $payer): self
    {
        $this->payer = $payer;

        return $this;
    }

    public function getPayee(): ?int
    {
        return $this->payee;
    }

    public function setPayee(int $payee): self
    {
        $this->payee = $payee;

        return $this;
    }
}
