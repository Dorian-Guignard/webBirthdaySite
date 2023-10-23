<?php

namespace App\Entity;

use App\Repository\GuestQuestionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GuestQuestionRepository::class)
 */
class GuestQuestion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $pax;

    /**
     * @ORM\Column(type="integer")
     */
    private $night;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $allergie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $regime;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="guestQuestion", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPax(): ?int
    {
        return $this->pax;
    }

    public function setPax(int $pax): self
    {
        $this->pax = $pax;

        return $this;
    }

    public function getNight(): ?int
    {
        return $this->night;
    }

    public function setNight(int $night): self
    {
        $this->night = $night;

        return $this;
    }

    public function getAllergie(): ?string
    {
        return $this->allergie;
    }

    public function setAllergie(?string $allergie): self
    {
        $this->allergie = $allergie;

        return $this;
    }

    public function getRegime(): ?string
    {
        return $this->regime;
    }

    public function setRegime(?string $regime): self
    {
        $this->regime = $regime;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
