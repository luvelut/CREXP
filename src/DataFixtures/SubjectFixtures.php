<?php

namespace App\DataFixtures;

use App\Entity\Subject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SubjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            TeacherFixtures::class,
            TeamFixtures::class,
            StudentFixtures::class,
            UserFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $teacher1= $this->getReference('teacher1');
        $teacher2= $this->getReference('teacher2');

        $team1= $this->getReference('team1');
        $team2= $this->getReference('team2');

        $subject1=new Subject();
        $subject1->setTeam($team1);
        $subject1->setTeacher($teacher1);
        $subject1->setNumberValues(1);
        $subject1->setTitle("TP de mécanique n°1");
        $subject1->setComment("Ce tp est un tp pour l'iut GIM");
        $subject1->setDocumentPath("doc1.pdf");
        $subject1->setPublishedAt(New \DateTime());


        $subject2=new Subject();
        $subject2->setTeam($team2);
        $subject2->setTeacher($teacher2);
        $subject2->setNumberValues(2);
        $subject2->setTitle("TP d'informatique'");
        $subject2->setComment("Ce tp est un tp pour l'iut INFO");
        $subject2->setDocumentPath("doc2.pdf");
        $subject2->setPublishedAt(New \DateTime());

        $subject3=new Subject();
        $subject3->setTeam($team1);
        $subject3->setTeacher($teacher1);
        $subject3->setNumberValues(1);
        $subject3->setTitle("TP de mécanique n°2");
        $subject3->setComment("Ce tp est un AUTRE tp pour l'iut GIM");
        $subject3->setDocumentPath("doc2.pdf");
        $subject3->setPublishedAt(New \DateTime());


        $manager->persist($subject2);
        $manager->persist($subject1);
        $manager->persist($subject3);

        $manager->flush();

        $this->addReference('subject1',$subject1);
        $this->addReference('subject2',$subject2);
        $this->addReference('subject3',$subject3);
    }
}
