<?php

namespace App\Entity;

use DateTime;
use App\Repository\UzytkownikRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UzytkownikRepository::class)
 * @ORM\Table(name="uzytkownicy")
 * @UniqueEntity("login")
 */
class Uzytkownik implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $imie;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nazwisko;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $czyDomenowy;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $login;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var mixed The hashed password
     * @ORM\Column(type="string", nullable=true)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $kiedyUtworzony;

    /**
     * @ORM\OneToMany(targetEntity=Wiadomosc::class, mappedBy="odKogo", orphanRemoval=true)
     */
    private $nadawca;

    /**
     * @ORM\OneToMany(targetEntity=Wiadomosc::class, mappedBy="doKogo", orphanRemoval=true)
     */
    private $odbiorca;

    /**
     * @ORM\ManyToOne(targetEntity=Dzielnica::class, inversedBy="uzytkownicy")
     */
    private $dzielnica;

    /**
     * @ORM\OneToMany(targetEntity=Formularz::class, mappedBy="worker")
     */
    private $formularze;


    public function __construct()
    {
        $this->kiedyUtworzony = new DateTime("now");
        $this->nadawca = new ArrayCollection();
        $this->odbiorca = new ArrayCollection();
        $this->formularze = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImie(): ?string
    {
        return $this->imie;
    }

    public function setImie(?string $imie): self
    {
        $this->imie = $imie;

        return $this;
    }

    public function getNazwisko(): ?string
    {
        return $this->nazwisko;
    }

    public function setNazwisko(?string $nazwisko): self
    {
        $this->nazwisko = $nazwisko;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCzyDomenowy(): ?int
    {
        return $this->czyDomenowy;
    }

    public function setCzyDomenowy(?int $czyDomenowy): self
    {
        $this->czyDomenowy = $czyDomenowy;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getKiedyUtworzony(): ?\DateTimeInterface
    {
        return $this->kiedyUtworzony;
    }

    public function setKiedyUtworzony(): self
    {
        $this->kiedyUtworzony;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->login;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->login;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Wiadomosc[]
     */
    public function getNadawca(): Collection
    {
        return $this->nadawca;
    }

    public function addNadawca(Wiadomosc $nadawca): self
    {
        if (!$this->nadawca->contains($nadawca)) {
            $this->nadawca[] = $nadawca;
            $nadawca->setOdKogo($this);
        }

        return $this;
    }

    public function removeNadawca(Wiadomosc $nadawca): self
    {
        if ($this->nadawca->removeElement($nadawca)) {
            // set the owning side to null (unless already changed)
            if ($nadawca->getOdKogo() === $this) {
                $nadawca->setOdKogo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Wiadomosc[]
     */
    public function getOdbiorca(): Collection
    {
        return $this->odbiorca;
    }

    public function addOdbiorca(Wiadomosc $odbiorca): self
    {
        if (!$this->odbiorca->contains($odbiorca)) {
            $this->odbiorca[] = $odbiorca;
            $odbiorca->setDoKogo($this);
        }

        return $this;
    }

    public function removeOdbiorca(Wiadomosc $odbiorca): self
    {
        if ($this->odbiorca->removeElement($odbiorca)) {
            // set the owning side to null (unless already changed)
            if ($odbiorca->getDoKogo() === $this) {
                $odbiorca->setDoKogo(null);
            }
        }

        return $this;
    }

    public function getDzielnica(): ?Dzielnica
    {
        return $this->dzielnica;
    }

    public function setDzielnica(?Dzielnica $dzielnica): self
    {
        $this->dzielnica = $dzielnica;

        return $this;
    }

    /**
     * @return Collection|Formularz[]
     */
    public function getFormularze(): Collection
    {
        return $this->formularze;
    }

    public function addFormularze(Formularz $formularze): self
    {
        if (!$this->formularze->contains($formularze)) {
            $this->formularze[] = $formularze;
            $formularze->setWorker($this);
        }

        return $this;
    }

    public function removeFormularze(Formularz $formularze): self
    {
        if ($this->formularze->removeElement($formularze)) {
            // set the owning side to null (unless already changed)
            if ($formularze->getWorker() === $this) {
                $formularze->setWorker(null);
            }
        }

        return $this;
    }
}
