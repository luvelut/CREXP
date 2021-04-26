<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 */
class Team
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank(message="Vous devez mettre un nom.")
     * @Assert\Length(max=20,min=1)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Student::class, mappedBy="team", orphanRemoval=true)
     */
    private $students;

    /**
     * @ORM\ManyToOne(targetEntity=Teacher::class, inversedBy="teams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $teacher;

    /**
     * @ORM\OneToMany(targetEntity=Subject::class, mappedBy="team")
     */
    private $subjects;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->subjects = new ArrayCollection();
    }

    public function getNbStudents():int
    {
        return $this->students->count();
    }

    public function getNbSubjects():int
    {
        return $this->subjects->count();
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
     * @return Collection|Student[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->setTeam($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getTeam() === $this) {
                $student->setTeam(null);
            }
        }

        return $this;
    }


    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    public function setTeacher(?Teacher $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * @return Collection|Subject[]
     */
    public function getSubjects(): Collection
    {
        return $this->subjects;
    }

    public function addSubject(Subject $subject): self
    {
        if (!$this->subjects->contains($subject)) {
            $this->subjects[] = $subject;
            $subject->setTeam($this);
        }

        return $this;
    }

    public function removeSubject(Subject $subject): self
    {
        if ($this->subjects->removeElement($subject)) {
            // set the owning side to null (unless already changed)
            if ($subject->getTeam() === $this) {
                $subject->setTeam(null);
            }
        }

        return $this;
    }
}
