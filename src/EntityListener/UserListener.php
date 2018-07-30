<?php

declare(strict_types=1);

namespace App\EntityListener;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserListener
{
    /** @var UserPasswordEncoderInterface */
    protected $encoder;

    /**
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param User $user
     */
    public function prePersist(User $user): void
    {
        if($user->getPlainPassword() || !$user->getPassword()) {
            $this->encodePassword($user);
        }
    }

    /**
     * @param User $user
     */
    public function preUpdate(User $user): void
    {
        if ($user->getPlainPassword()) {
            $this->encodePassword($user);
        }
    }

    /**
     * @param User $user
     */
    protected function encodePassword(User $user): void
    {
        $password = $this->encoder->encodePassword($user, $user->getPlainPassword());

        $user->setPlainPassword(null);
        $user->setPassword($password);
    }
}