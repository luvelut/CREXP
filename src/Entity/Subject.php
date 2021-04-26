<?php

namespace App\Entity;

use App\Repository\SubjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=SubjectRepository::class)
 * @Vich\Uploadable
 */
class Subject
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Vous devez mettre un nombre de valeurs.")
     */
    private $numberValues;

    /**
     * @ORM\Column(type="string", length=40)
     * @Assert\Length(max=40,min=1,maxMessage="Le titre du sujet ne doit pas dépasser 40 caractères.")
     * @Assert\NotBlank(message="Vous devez mettre un titre.")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(max=40,min=1,maxMessage="Le commentaire ne doit pas dépasser 100 caractères.")
     * @Assert\NotBlank(message="Vous devez mettre un commentaire.")
     */
    private $comment;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Length(max=40,min=1,maxMessage="Le nom du fichier est trop long.")
     */
    private $documentPath;

    /**
     * @Vich\UploadableField(mapping="subjects", fileNameProperty="documentPath")
     * @var File
     */
    private $documentFile;

    /**
     * @ORM\Column(type="date")
     */
    private $publishedAt;

    /**
     * @ORM\OneToMany(targetEntity=Exercise::class, mappedBy="subject", orphanRemoval=true)
     */
    private $exercises;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="subjects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity=Teacher::class, inversedBy="subjects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $teacher;

    public function __construct()
    {
        $this->exercises = new ArrayCollection();
    }

    public function setDocumentFile(File $image = null)
    {
        $this->documentFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->publishedAt = new \DateTime('now');
        }
    }

    public function getDocumentFile(): ?File
    {
        return $this->documentFile;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberValues(): ?int
    {
        return $this->numberValues;
    }

    public function setNumberValues(int $numberValues): self
    {
        $this->numberValues = $numberValues;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getDocumentPath(): ?string
    {
        return $this->documentPath;
    }

    public function setDocumentPath(?string $documentPath): self
    {
        $this->documentPath = $documentPath;

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

    /**
     * @return Collection|Exercise[]
     */
    public function getExercises(): Collection
    {
        return $this->exercises;
    }

    public function addExercise(Exercise $exercise): self
    {
        if (!$this->exercises->contains($exercise)) {
            $this->exercises[] = $exercise;
            $exercise->setSubject($this);
        }

        return $this;
    }

    public function removeExercise(Exercise $exercise): self
    {
        if ($this->exercises->removeElement($exercise)) {
            // set the owning side to null (unless already changed)
            if ($exercise->getSubject() === $this) {
                $exercise->setSubject(null);
            }
        }

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

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
}
