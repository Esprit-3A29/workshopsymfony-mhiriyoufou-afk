<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]

    #[ORM\Column]
    private ?int $nsc = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $username = null;

    #[ORM\Column(nullable: true)]
    private ?float $moyenne = null;

    #[ORM\ManyToOne(inversedBy: 'studentsClass')]
    #[ORM\joinColumn(onDelete:"CASCADE")]
    private ?Classroom $classrooms = null;

    public function getNsc(): ?int
    {
        return $this->nsc;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getMoyenne(): ?float
    {
        return $this->moyenne;
    }

    public function setMoyenne(?float $moyenne): self
    {
        $this->moyenne = $moyenne;

        return $this;
    }

    public function getClassrooms(): ?Classroom
    {
        return $this->classrooms;
    }

    public function setClassrooms(?Classroom $classrooms): self
    {
        $this->classrooms = $classrooms;

        return $this;
    }
}
