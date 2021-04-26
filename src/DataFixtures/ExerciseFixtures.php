<?php

namespace App\DataFixtures;

use App\Entity\Exercise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ExerciseFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            TeacherFixtures::class,
            TeamFixtures::class,
            StudentFixtures::class,
            UserFixtures::class,
            SubjectFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $student1= $this->getReference('student1');
        $student2= $this->getReference('student2');
        $student3= $this->getReference('student3');
        $student4= $this->getReference('student4');
        $student5= $this->getReference('student5');
        $student6= $this->getReference('student6');
        $student7= $this->getReference('student7');
        $student8= $this->getReference('student8');
        $student9= $this->getReference('student9');
        $student10= $this->getReference('student10');

        $subject1= $this->getReference('subject1');
        $subject2= $this->getReference('subject2');
        $subject3= $this->getReference('subject3');

        $ex1=new Exercise();
        $ex1->setSubject($subject1);
        $ex1->setStudent($student1);
        $ex1->setState("ATTENTE");
        $ex1->setResponse("1|1|1");
        $ex1->setPublishedAt(New \DateTime());


        $ex2=new Exercise();
        $ex2->setSubject($subject2);
        $ex2->setStudent($student2);
        $ex2->setState("OK-ELEVE");
        $ex2->setResponse("2 2 2");
        $ex2->setPublishedAt(New \DateTime());

        $ex3=new Exercise();
        $ex3->setSubject($subject3);
        $ex3->setStudent($student1);
        $ex3->setState("OK-PROF");
        $ex3->setResponse("3 3 3");
        $ex3->setPublishedAt(New \DateTime());

        $ex4=new Exercise();
        $ex4->setSubject($subject1);
        $ex4->setStudent($student3);
        $ex4->setState("OK-PROF");
        $ex4->setResponse("3 3 3");
        $ex4->setPublishedAt(New \DateTime());

        $ex5=new Exercise();
        $ex5->setSubject($subject2);
        $ex5->setStudent($student4);
        $ex5->setState("OK-ELEVE");
        $ex5->setResponse("3 3 3");
        $ex5->setPublishedAt(New \DateTime());

        $ex6=new Exercise();
        $ex6->setSubject($subject3);
        $ex6->setStudent($student4);
        $ex6->setState("ATTENTE");
        $ex6->setResponse("3 3 3");
        $ex6->setPublishedAt(New \DateTime());

        $ex7=new Exercise();
        $ex7->setSubject($subject1);
        $ex7->setStudent($student5);
        $ex7->setState("ATTENTE");
        $ex7->setResponse("3 3 3");
        $ex7->setPublishedAt(New \DateTime());

        $ex8=new Exercise();
        $ex8->setSubject($subject2);
        $ex8->setStudent($student6);
        $ex8->setState("OK-PROF");
        $ex8->setResponse("3 3 3");
        $ex8->setPublishedAt(New \DateTime());

        $ex9=new Exercise();
        $ex9->setSubject($subject3);
        $ex9->setStudent($student6);
        $ex9->setState("OK-ELEVE");
        $ex9->setResponse("3 3 3");
        $ex9->setPublishedAt(New \DateTime());

        $ex10=new Exercise();
        $ex10->setSubject($subject1);
        $ex10->setStudent($student7);
        $ex10->setState("OK-ELEVE");
        $ex10->setResponse("3 3 3");
        $ex10->setPublishedAt(New \DateTime());

        $ex11=new Exercise();
        $ex11->setSubject($subject2);
        $ex11->setStudent($student8);
        $ex11->setState("OK-ELEVE");
        $ex11->setResponse("3 3 3");
        $ex11->setPublishedAt(New \DateTime());

        $ex13=new Exercise();
        $ex13->setSubject($subject3);
        $ex13->setStudent($student8);
        $ex13->setState("OK-ELEVE");
        $ex13->setResponse("3 3 3");
        $ex13->setPublishedAt(New \DateTime());

        $ex12=new Exercise();
        $ex12->setSubject($subject1);
        $ex12->setStudent($student9);
        $ex12->setState("OK-PROF");
        $ex12->setResponse("3 3 3");
        $ex12->setPublishedAt(New \DateTime());

        $ex14=new Exercise();
        $ex14->setSubject($subject2);
        $ex14->setStudent($student10);
        $ex14->setState("OK-ELEVE");
        $ex14->setResponse("3 3 3");
        $ex14->setPublishedAt(New \DateTime());

        $ex15=new Exercise();
        $ex15->setSubject($subject3);
        $ex15->setStudent($student10);
        $ex15->setState("ATTENTE");
        $ex15->setResponse("3 3 3");
        $ex15->setPublishedAt(New \DateTime());

        $manager->persist($ex1);
        $manager->persist($ex2);
        $manager->persist($ex3);
        $manager->persist($ex4);
        $manager->persist($ex5);
        $manager->persist($ex6);
        $manager->persist($ex7);
        $manager->persist($ex8);
        $manager->persist($ex9);
        $manager->persist($ex10);
        $manager->persist($ex11);
        $manager->persist($ex12);
        $manager->persist($ex13);
        $manager->persist($ex14);
        $manager->persist($ex15);

        $manager->flush();
    }
}
