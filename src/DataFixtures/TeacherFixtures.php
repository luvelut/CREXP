<?php

namespace App\DataFixtures;

use App\Entity\Teacher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TeacherFixtures extends Fixture
{


    public function load(ObjectManager $manager)
    {
        //création des teachers

        $teacher1=new Teacher();
        $teacher1->setName("Christophe Velut");

        $teacher2=new Teacher();
        $teacher2->setName("Pascale Brigoulet");

        $manager->persist($teacher1);
        $manager->persist($teacher2);

        $manager->flush();

        $this->addReference('teacher1',$teacher1);
        $this->addReference('teacher2',$teacher2);
    }
}
