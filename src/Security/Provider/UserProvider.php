<?php

namespace App\Security\Provider;

use App\Entity\Admin;
use App\Entity\Employee;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    /** @var UserRepository */
    protected $repository;

    /** @var UserPasswordEncoderInterface */
    protected $passwordEncoder;

    /** @var array */
    protected $classes = [];

    /**
     * @param UserRepository $repository
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserRepository $repository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->repository = $repository;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param array $classes
     */
    public function setSupportedClasses(array $classes)
    {
        $this->classes = $classes;
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        $user = $this->repository->findOneByEmail($username);

        $this->validateUser($user, $username);

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsernameAndPassword(string $username, string $password)
    {
        $user = $this->loadUserByUsername($username);

        if (!$this->passwordEncoder->isPasswordValid($user, $password)) {
            throw new BadCredentialsException('Invalid credentials.');
        }

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$this->supportsClass(get_class($user))) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        $refreshedUser = $this->repository->findOneById($user->getId());

        if (null === $refreshedUser) {
            throw new UsernameNotFoundException(sprintf('User with id %s not found', json_encode($user->getId())));
        }

        return $refreshedUser;
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return in_array($class, [
            User::class,
            Admin::class,
            Employee::class
        ]);
    }

    /**
     * @param User|null $user
     * @param string $username
     */
    protected function validateUser($user, string $username)
    {
        if (null === $user) {
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
        }

        if (!$this->supportsClass(get_class($user))) {
            throw new UsernameNotFoundException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }
    }
}
