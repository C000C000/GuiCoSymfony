<?php

namespace App\Entity;

use App\Repository\ListeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListeRepository::class)]
class Liste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $IdUser;

    #[ORM\ManyToMany(targetEntity: Films::class)]
    private $IdFilms;

    public function __construct()
    {
        $this->IdFilms = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Films>
     */
    public function getIdFilms(): Collection
    {
        return $this->IdFilms;
    }

    public function addIdFilm(Films $idFilm): self
    {
        if (!$this->IdFilms->contains($idFilm)) {
            $this->IdFilms[] = $idFilm;
        }

        return $this;
    }

    public function removeIdFilm(Films $idFilm): self
    {
        $this->IdFilms->removeElement($idFilm);

        return $this;
    }
}
