<?php


namespace App\Security\Voters;


use App\Entity\Student;
use App\Entity\Teacher;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class StudentVoter extends Voter
{
    const DELETE = 'delete';
    const EDIT = 'edit';

    protected function supports(string $attribute, $subject) : bool
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::DELETE, self::EDIT])) {
            return false;
        }

        // only vote on Student objects
        if (!$subject instanceof Student) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user=$token->getUser();
        if(null===$user){
            return false;
        }

        $teacher = $user->getTeacher();

        if (!$teacher instanceof Teacher) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a Student object, thanks to `supports()`
        /** @var Student $student */
        $student = $subject;

        switch ($attribute) {
            case self::DELETE:
                return $this->canDelete($student, $teacher);
            case self::EDIT:
                return $this->canEdit($student, $teacher);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canDelete(Student $student, Teacher $teacher): bool
    {
        // if they can edit, they can view
        if ($this->canEdit($student, $teacher)) {
            return true;
        }

        return false;
    }

    private function canEdit(Student $student, Teacher $teacher): bool
    {
        return $teacher === $student->getTeam()->getTeacher();
    }

}