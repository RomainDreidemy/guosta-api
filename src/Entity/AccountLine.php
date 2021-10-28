<?php

namespace App\Entity;

use App\Repository\AccountLineRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AccountLineRepository::class)
 */
class AccountLine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['Account:read'])]
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['Account:read'])]
    private string $designation;

    /**
     * @ORM\Column(type="float")
     */
    #[Groups(['Account:read'])]
    private float $sum;

    /**
     * @ORM\Column(type="date")
     */
    #[Groups(['Account:read'])]
    private \DateTime $date;

    /**
     * @ORM\Column(type="boolean")
     */
    #[Groups(['Account:read'])]
    private bool $inApplication;

    /**
     * @ORM\Column(type="boolean")
     */
    #[Groups(['Account:read'])]
    private bool $monthly;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class, inversedBy="accountLines")
     */
    private $account;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getSum(): ?float
    {
        return $this->sum;
    }

    public function setSum(float $sum): self
    {
        $this->sum = $sum;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getInApplication(): ?bool
    {
        return $this->inApplication;
    }

    public function setInApplication(bool $inApplication): self
    {
        $this->inApplication = $inApplication;

        return $this;
    }

    public function getMonthly(): ?bool
    {
        return $this->monthly;
    }

    public function setMonthly(bool $monthly): self
    {
        $this->monthly = $monthly;

        return $this;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(?Account $account): self
    {
        $this->account = $account;

        return $this;
    }
}
