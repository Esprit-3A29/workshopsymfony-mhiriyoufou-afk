<?php

namespace App\Entity;

use App\Repository\ClassroomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassroomRepository::class)]
class Classroom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'classrooms', targetEntity: Student::class)]
    private Collection $studentsClass;


    public function __construct()
    {
        $this->studentId = new ArrayCollection();
        $this->studentsClass = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getStudentsClass(): Collection
    {
        return $this->studentsClass;
    }

    public function addStudentsClass(Student $studentsClass): self
    {
        if (!$this->studentsClass->contains($studentsClass)) {
            $this->studentsClass->add($studentsClass);
            $studentsClass->setClassrooms($this);
        }

        return $this;
    }

    public function removeStudentsClass(Student $studentsClass): self
    {
        if ($this->studentsClass->removeElement($studentsClass)) {
            // set the owning side to null (unless already changed)
            if ($studentsClass->getClassrooms() === $this) {
                $studentsClass->setClassrooms(null);
            }
        }

        return $this;
    }

}
