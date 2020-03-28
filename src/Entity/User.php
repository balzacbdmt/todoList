<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Usergroup", mappedBy="users")
     */
    private $usergroups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Todo", mappedBy="users")
     */
    private $todos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Label", mappedBy="Users")
     */
    private $labels;

    public function __construct()
    {
        $this->usergroups = new ArrayCollection();
        $this->todos = new ArrayCollection();
        $this->labels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials() {}

    public function getSalt() {}
    
    public function getRoles() {
        return ['ROLE_USER'];
    }

    /**
     * @return Collection|Usergroup[]
     */
    public function getUsergroups(): Collection
    {
        return $this->usergroups;
    }

    public function addUsergroup(Usergroup $usergroup): self
    {
        if (!$this->usergroups->contains($usergroup)) {
            $this->usergroups[] = $usergroup;
            $usergroup->addUser($this);
        }

        return $this;
    }

    public function removeUsergroup(Usergroup $usergroup): self
    {
        if ($this->usergroups->contains($usergroup)) {
            $this->usergroups->removeElement($usergroup);
            $usergroup->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Todo[]
     */
    public function getTodos(): Collection
    {
        return $this->todos;
    }

    public function addTodo(Todo $todo): self
    {
        if (!$this->todos->contains($todo)) {
            $this->todos[] = $todo;
            $todo->setUsers($this);
        }

        return $this;
    }

    public function removeTodo(Todo $todo): self
    {
        if ($this->todos->contains($todo)) {
            $this->todos->removeElement($todo);
            // set the owning side to null (unless already changed)
            if ($todo->getUsers() === $this) {
                $todo->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return string String representation of this class
     */
    public function __toString()
    {
        return $this->username;
    }

    /**
     * @return Collection|Label[]
     */
    public function getLabels(): Collection
    {
        return $this->labels;
    }

    public function addLabel(Label $label): self
    {
        if (!$this->labels->contains($label)) {
            $this->labels[] = $label;
            $label->setUsers($this);
        }

        return $this;
    }

    public function removeLabel(Label $label): self
    {
        if ($this->labels->contains($label)) {
            $this->labels->removeElement($label);
            // set the owning side to null (unless already changed)
            if ($label->getUsers() === $this) {
                $label->setUsers(null);
            }
        }

        return $this;
    }
}
