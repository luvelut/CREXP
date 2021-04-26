<?php


namespace App\Model\Search;


use App\Entity\Teacher;

class SubjectSearch
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
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return SubjectSearch
     */
    public function setName(?string $name): SubjectSearch
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
     * @return SubjectSearch
     */
    public function setTeacher(?Teacher $teacher): SubjectSearch
    {
        $this->teacher = $teacher;
        return $this;
    }



}