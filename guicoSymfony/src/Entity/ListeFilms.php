<?php

namespace App\Entity;

use App\Repository\ListeFilmsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListeFilmsRepository::class)]
class ListeFilms
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'listeFilms')]
    #[ORM\JoinColumn(nullable: false)]
    private $IdUser;

    #[ORM\Column(type: 'integer')]
    private $IdFilm;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->IdUser;
    }

    public function setIdUser(?User $IdUser): self
    {
        $this->IdUser = $IdUser;

        return $this;
    }

    public function getIdFilm(): ?int
    {
        return $this->IdFilm;
    }

    public function setIdFilm(int $IdFilm): self
    {
        $this->IdFilm = $IdFilm;

        return $this;
    }
}
