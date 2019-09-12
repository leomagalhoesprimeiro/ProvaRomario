<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlunoRepository")
 */
class Aluno
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
    private $bolsista;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projeto", inversedBy="alunos")
     */
    private $proj;

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

    public function getBolsista(): ?bool
    {
        return $this->bolsista;
    }

    public function setBolsista(bool $bolsista): self
    {
        $this->bolsista = $bolsista;

        return $this;
    }

    public function getProj(): ?Projeto
    {
        return $this->proj;
    }

    public function setProj(?Projeto $proj): self
    {
        $this->proj = $proj;

        return $this;
    }
}
