<?php


namespace App\Security\Voters;


use App\Entity\Exercise;
use App\Entity\Student;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ExerciseVoter extends Voter
{

    const VIEW = 'view';
    const EDIT = 'edit';

    protected function supports(string $attribute, $subject) : bool
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::VIEW, self::EDIT])) {
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

        $student = $user->getStudent();

        if (!$student instanceof Student) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a Exercise object, thanks to `supports()`
        /** @var Exercise $exercise */
        $exercise = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($exercise, $student);
            case self::EDIT:
                return $this->canEdit($exercise, $student);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(Exercise $exercise, Student $student): bool
    {
        // if they can edit, they can view
        if ($this->canEdit($exercise, $student)) {
            return true;
        }

        return false;
    }

    private function canEdit(Exercise $exercise, Student $student): bool
    {
        return $student === $exercise->getStudent();
    }

}