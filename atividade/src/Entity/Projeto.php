<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjetoRepository")
 */
class Projeto
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
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aluno", mappedBy="proj")
     */
    private $alunos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Professor", inversedBy="proj")
     */
    private $professor;

    public function __construct()
    {
        $this->alunos = new ArrayCollection();
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

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Aluno[]
     */
    public function getAlunos(): Collection
    {
        return $this->alunos;
    }

    public function addAluno(Aluno $aluno): self
    {
        if (!$this->alunos->contains($aluno)) {
            $this->alunos[] = $aluno;
            $aluno->setProj($this);
        }

        return $this;
    }

    public function removeAluno(Aluno $aluno): self
    {
        if ($this->alunos->contains($aluno)) {
            $this->alunos->removeElement($aluno);
            // set the owning side to null (unless already changed)
            if ($aluno->getProj() === $this) {
                $aluno->setProj(null);
            }
        }

        return $this;
    }

    public function getProfessor(): ?Professor
    {
        return $this->professor;
    }

    public function setProfessor(?Professor $professor): self
    {
        $this->professor = $professor;

        return $this;
    }
}
