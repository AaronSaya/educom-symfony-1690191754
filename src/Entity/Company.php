<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'company', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $logo_url = null;

    #[ORM\Column(length: 50)]
    private ?string $location = null;

    #[ORM\ManyToOne(inversedBy: 'company')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vacancies $date = null;

    #[ORM\ManyToOne(inversedBy: 'company')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vacancies $vacancies = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLogoUrl(): ?string
    {
        return $this->logo_url;
    }

    public function setLogoUrl(string $logo_url): static
    {
        $this->logo_url = $logo_url;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getDate(): ?Vacancies
    {
        return $this->date;
    }

    public function setDate(?Vacancies $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getVacancies(): ?Vacancies
    {
        return $this->vacancies;
    }

    public function setVacancies(?Vacancies $vacancies): static
    {
        $this->vacancies = $vacancies;

        return $this;
    }
}
