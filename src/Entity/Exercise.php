<?php

namespace App\Entity;

use App\Repository\ExerciseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ExerciseRepository::class)
 */
class Exercise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $state;

    const ATTENTE = 'ATTENTE';
    const OK_ELEVE = 'OK-ELEVE';
    const OK_PROF = 'OK-PROF';

    /**
     * @ORM\Column(type="date")
     */
    private $publishedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="exercises")
     * @ORM\JoinColumn(nullable=false)
     */
    private $student;

    /**
     * @ORM\ManyToOne(targetEntity=Subject::class, inversedBy="exercises")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subject;

    /**
     * @ORM\Column(type="string", length=250)
     * @Assert\Length(max=250,min=1,maxMessage="Votre réponse doit avoir entre 1 et 250 caractères.")
     * @Assert\NotBlank(message="Vous devez mettre une réponse.")
     */
    private $response;

    public function validateStudentState(){
        $this->setState(Exercise::OK_ELEVE);
    }

    public function validateTeacherState(){
        $this->setState(Exercise::OK_PROF);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }

    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    public function setSubject(?Subject $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }

    public function setResponse(string $response): self
    {
        $this->response = $response;

        return $this;
    }
}
