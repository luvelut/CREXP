<?php


namespace App\Model\Search;


use App\Entity\Student;
use App\Entity\Teacher;

class ExerciseSearch
{
    /**
     * @var ?string
     */
    private $name = '';

    /**
     * @var ?Teacher
     */
    private $teacher;

    /**
     * @var ?Student
     */
    private $student;

    /**
     * @var bool
     */
    public $isCheck = false;

    /**
     * @return bool
     */
    private function isCheck(): bool
    {
        return $this->isCheck;
    }

    /**
     * @param bool $isCheck
     * @return ExerciseSearch
     */
    public function setIsCheck(bool $isCheck): ExerciseSearch
    {
        $this->isCheck = $isCheck;
        return $this;
    }



    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return ExerciseSearch
     */
    public function setName(?string $name): ExerciseSearch
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Teacher|null
     */
    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    /**
     * @param Teacher|null $teacher
     * @return ExerciseSearch
     */
    public function setTeacher(?Teacher $teacher): ExerciseSearch
    {
        $this->teacher = $teacher;
        return $this;
    }

    /**
     * @return Student|null
     */
    public function getStudent(): ?Student
    {
        return $this->student;
    }

    /**
     * @param Student|null $student
     * @return ExerciseSearch
     */
    public function setStudent(?Student $student): ExerciseSearch
    {
        $this->student = $student;
        return $this;
    }


}