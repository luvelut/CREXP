<?php


namespace App\Security\Voters;



use App\Entity\Subject;
use App\Entity\Teacher;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class SubjectVoter extends Voter
{

    const DELETE = 'delete';
    const EDIT = 'edit';

    protected function supports(string $attribute, $subject) : bool
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::DELETE, self::EDIT])) {
            return false;
        }

        // only vote on Subject objects
        if (!$subject instanceof Subject) {
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

        // you know $subject is a Subject object, thanks to `supports()`
        /** @var Subject $mySubject */
        $mySubject = $subject;

        switch ($attribute) {
            case self::DELETE:
                return $this->canDelete($mySubject, $teacher);
            case self::EDIT:
                return $this->canEdit($mySubject, $teacher);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canDelete(Subject $mySubject, Teacher $teacher): bool
    {
        // if they can edit, they can view
        if ($this->canEdit($mySubject, $teacher)) {
            return true;
        }

        return false;
    }

    private function canEdit(Subject $mySubject, Teacher $teacher): bool
    {
        return $teacher === $mySubject->getTeacher();
    }
}