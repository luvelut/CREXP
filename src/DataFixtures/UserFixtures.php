<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder ){
        $this->encoder = $encoder;
    }

    public function getDependencies(): array
    {
        return [
            TeacherFixtures::class,
            TeamFixtures::class,
            StudentFixtures::class,
        ];
    }
    public function load(ObjectManager $manager)
    {
        $teacher1= $this->getReference('teacher1');
        $teacher2= $this->getReference('teacher2');
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

        $user1=new User();
        $user1->setLogin("cvelut");
        $user1->setPassword($this->encoder->encodePassword($user1,'pswcv'));
        $user1->setTeacher($teacher1);

        $user2=new User();
        $user2->setLogin("pbrigoulet");
        $user2->setPassword("pswpb");
        $user2->setTeacher($teacher2);

        $user4=new User();
        $user4->setLogin("lvelut");
        $user4->setPassword($this->encoder->encodePassword($user4,'pswlv'));
        $user4->setStudent($student2);

        $user3=new User();
        $user3->setLogin("qroche");
        $user3->setPassword("pswqr");
        $user3->setStudent($student1);

        $user5=new User();
        $user5->setLogin("plouis");
        $user5->setPassword("pswqr");
        $user5->setStudent($student3);

        $user6=new User();
        $user6->setLogin("zlegrand");
        $user6->setPassword("pswqr");
        $user6->setStudent($student4);

        $user7=new User();
        $user7->setLogin("jvand");
        $user7->setPassword("pswqr");
        $user7->setStudent($student5);

        $user8=new User();
        $user8->setLogin("ljour");
        $user8->setPassword("pswqr");
        $user8->setStudent($student6);

        $user9=new User();
        $user9->setLogin("lheritier");
        $user9->setPassword("pswqr");
        $user9->setStudent($student7);

        $user10=new User();
        $user10->setLogin("lmenna");
        $user10->setPassword("pswqr");
        $user10->setStudent($student8);

        $user11=new User();
        $user11->setLogin("cdupond");
        $user11->setPassword("pswqr");
        $user11->setStudent($student9);

        $user12=new User();
        $user12->setLogin("jroydor");
        $user12->setPassword("pswqr");
        $user12->setStudent($student10);

        $manager->persist($user1);
        $manager->persist($user2);
        $manager->persist($user3);
        $manager->persist($user4);
        $manager->persist($user5);
        $manager->persist($user6);
        $manager->persist($user7);
        $manager->persist($user8);
        $manager->persist($user9);
        $manager->persist($user10);
        $manager->persist($user11);
        $manager->persist($user12);

        $manager->flush();
    }
}
