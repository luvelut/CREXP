<?php


namespace App\Service\User;


use App\Entity\User;
use App\Repository\UserRepository;

class SearchProvider
{
    private UserRepository $userRepository;

    /**
     * SearchProvider constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function getUser($student) : ?User {
        return $this->userRepository->findOneBy(['student'=>$student]);
    }
}