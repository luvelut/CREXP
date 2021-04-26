<?php

namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TeamFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            TeacherFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $teacher1= $this->getReference('teacher1');
        $teacher2= $this->getReference('teacher2');

        $team1=new Team();
        $team1->setTeacher($teacher1);
        $team1->setName("IUT GIM");

        $team2=new Team();
        $team2->setTeacher($teacher2);
        $team2->setName("IUT INFO");

        $manager->persist($team1);
        $manager->persist($team2);

        $manager->flush();

        $this->addReference('team1',$team1);
        $this->addReference('team2',$team2);
    }
}
