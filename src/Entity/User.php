<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface,\Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\Length(max=40,min=1,maxMessage="Le login de l'étudiant ne doit pas dépasser 20 caractères.")
     * @Assert\NotBlank(message="Vous devez mettre un login.")
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $password;

    /**
     * @ORM\OneToOne(targetEntity=Teacher::class, inversedBy="user", cascade={"persist", "remove"})
     */
    private $teacher;

    /**
     * @ORM\OneToOne(targetEntity=Student::class, inversedBy="user", cascade={"persist", "remove"})
     */
    private $student;

    /**
     * @Assert\Regex(
     *     pattern = "/^[a-zA-Z0-9]{8,}$/",
     *     match=true,
     *     message="Le mot de passe doit comporter au moins huit caractères, dont des lettres majuscules et minuscules et un chiffre."
     * )
     * @Assert\NotBlank(message="Vous devez mettre un mot de passe.")
     */
    private $plainPassword;

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }

    public function getRoles()
    {
        if($this->teacher){
            return ['ROLE_TEACHER'];
        }
        return ['ROLE_STUDENT'];
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->getLogin();
    }

    public function eraseCredentials()
    {

    }

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->login,
            $this->password
        ]);
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->login,
            $this->password
            ) = unserialize($serialized,['allowed_classes'=>false]);
    }
}
