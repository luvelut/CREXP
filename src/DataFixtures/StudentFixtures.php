<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class StudentFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            TeacherFixtures::class,
            TeamFixtures::class,
        ];
    }
    public function load(ObjectManager $manager)
    {
        $team1= $this->getReference('team1');
        $team2= $this->getReference('team2');

        $student1=new Student();
        $student1->setName("Quentin Roche");
        $student1->setTeam($team1);

        $student2=new Student();
        $student2->setName("Lucile Velut");
        $student2->setTeam($team2);

        $student3=new Student();
        $student3->setName("Pierre Louis");
        $student3->setTeam($team1);

        $student4=new Student();
        $student4->setName("Zoe Legrand");
        $student4->setTeam($team2);

        $student5=new Student();
        $student5->setName("Jean Vand");
        $student5->setTeam($team1);

        $student6=new Student();
        $student6->setName("Lucas Jour");
        $student6->setTeam($team2);

        $student7=new Student();
        $student7->setName("Lise Heritier");
        $student7->setTeam($team1);

        $student8=new Student();
        $student8->setName("Louise Menna");
        $student8->setTeam($team2);

        $student9=new Student();
        $student9->setName("Chris Dupond");
        $student9->setTeam($team1);

        $student10=new Student();
        $student10->setName("Jeanne Roydor");
        $student10->setTeam($team2);

        $manager->persist($student1);
        $manager->persist($student2);
        $manager->persist($student3);
        $manager->persist($student4);
        $manager->persist($student5);
        $manager->persist($student6);
        $manager->persist($student7);
        $manager->persist($student8);
        $manager->persist($student9);
        $manager->persist($student10);

        $manager->flush();

        $this->addReference('student1',$student1);
        $this->addReference('student2',$student2);
        $this->addReference('student3',$student3);
        $this->addReference('student4',$student4);
        $this->addReference('student5',$student5);
        $this->addReference('student6',$student6);
        $this->addReference('student7',$student7);
        $this->addReference('student8',$student8);
        $this->addReference('student9',$student9);
        $this->addReference('student10',$student10);
    }
}
