<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfessorRepository")
 */
class Professor
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
    private $nome;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $projeto_status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Projeto", mappedBy="professor")
     */
    private $proj;

    public function __construct()
    {
        $this->proj = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getProjetoStatus(): ?string
    {
        return $this->projeto_status;
    }

    public function setProjetoStatus(string $projeto_status): self
    {
        $this->projeto_status = $projeto_status;

        return $this;
    }

    /**
     * @return Collection|Projeto[]
     */
    public function getProj(): Collection
    {
        return $this->proj;
    }

    public function addProj(Projeto $proj): self
    {
        if (!$this->proj->contains($proj)) {
            $this->proj[] = $proj;
            $proj->setProfessor($this);
        }

        return $this;
    }

    public function removeProj(Projeto $proj): self
    {
        if ($this->proj->contains($proj)) {
            $this->proj->removeElement($proj);
            // set the owning side to null (unless already changed)
            if ($proj->getProfessor() === $this) {
                $proj->setProfessor(null);
            }
        }

        return $this;
    }
}
