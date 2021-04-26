<?php


namespace App\Model\Search;


use App\Entity\Teacher;

class TeamSearch
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
     * @return TeamSearch
     */
    public function setName(?string $name): TeamSearch
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
     * @return TeamSearch
     */
    public function setTeacher(?Teacher $teacher): TeamSearch
    {
        $this->teacher = $teacher;
        return $this;
    }

}