<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $nom;

    #[ORM\Column(type: 'text')]
    private $prenom;

    #[ORM\Column(type: 'text')]
    private $mail;

    #[ORM\Column(type: 'integer')]
    private $age;

    #[ORM\Column(type: 'text')]
    private $motDePasse;

    #[ORM\Column(type: 'text')]
    private $role;

    #[ORM\OneToMany(mappedBy: 'IdUser', targetEntity: ListeFilms::class)]
    private $listeFilms;

    public function __construct()
    {
        $this->listeFilms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->motDePasse;
    }

    public function getRoles(): array
    {
        return [$this->role];
    }

    public function eraseCredentials()
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->getMail();
    }

    /**
     * @return Collection<int, ListeFilms>
     */
    public function getListeFilms(): Collection
    {
        return $this->listeFilms;
    }

    public function addListeFilm(ListeFilms $listeFilm): self
    {
        if (!$this->listeFilms->contains($listeFilm)) {
            $this->listeFilms[] = $listeFilm;
            $listeFilm->setIdUser($this);
        }

        return $this;
    }

    public function removeListeFilm(ListeFilms $listeFilm): self
    {
        if ($this->listeFilms->removeElement($listeFilm)) {
            // set the owning side to null (unless already changed)
            if ($listeFilm->getIdUser() === $this) {
                $listeFilm->setIdUser(null);
            }
        }

        return $this;
    }
}
