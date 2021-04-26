<?php


namespace App\Security\Voters;


use App\Entity\Exercise;
use App\Entity\Student;
use App\Entity\Teacher;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class AnswerVoter extends Voter
{
    const SHOW = 'show';
    const VALIDATE = 'validate';

    protected function supports(string $attribute, $subject) : bool
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::SHOW, self::VALIDATE])) {
            return false;
        }

        // only vote on Exercise objects
        if (!$subject instanceof Exercise) {
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

        // you know $subject is a Exercise object, thanks to `supports()`
        /** @var Exercise $exercise */
        $exercise = $subject;

        switch ($attribute) {
            case self::SHOW:
                return $this->canView($exercise, $teacher);
            case self::VALIDATE:
                return $this->canEdit($exercise, $teacher);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(Exercise $exercise, Teacher $teacher): bool
    {
        // if they can edit, they can view
        if ($this->canEdit($exercise, $teacher)) {
            return true;
        }

        return false;
    }

    private function canEdit(Exercise $exercise, Teacher $teacher): bool
    {
        return $teacher === $exercise->getSubject()->getTeacher();
    }
}