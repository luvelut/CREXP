<?php


namespace App\Model\Search;

use App\Entity\Teacher;

class StudentSearch
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
     * @return StudentSearch
     */
    public function setName(?string $name): StudentSearch
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
     * @return StudentSearch
     */
    public function setTeacher(?Teacher $teacher): StudentSearch
    {
        $this->teacher = $teacher;
        return $this;
    }


}