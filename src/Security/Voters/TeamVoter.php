<?php


namespace App\Security\Voters;



use App\Entity\Teacher;
use App\Entity\Team;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class TeamVoter extends Voter
{
    const DELETE = 'delete';
    const EDIT = 'edit';

    protected function supports(string $attribute, $subject) : bool
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::DELETE, self::EDIT])) {
            return false;
        }

        // only vote on Team objects
        if (!$subject instanceof Team) {
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

        // you know $subject is a Team object, thanks to `supports()`
        /** @var Team $team */
        $team = $subject;

        switch ($attribute) {
            case self::DELETE:
                return $this->canDelete($team, $teacher);
            case self::EDIT:
                return $this->canEdit($team, $teacher);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canDelete(Team $team, Teacher $teacher): bool
    {
        // if they can edit, they can view
        if ($this->canEdit($team, $teacher)) {
            return true;
        }

        return false;
    }

    private function canEdit(Team $team, Teacher $teacher): bool
    {
        dump($teacher);
        return $teacher === $team->getTeacher();
    }
}