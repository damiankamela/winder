<?php

declare(strict_types=1);

namespace App\Command\User;

use App\Entity\Admin;
use App\Entity\Employee;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class CreateUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:user:create')
            ->setDescription('Creates user.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'User Creator',
            '============',
            '',
        ]);

        $helper = $this->getHelper('question');

        $question = new ChoiceQuestion(
            'Please select user type:',
            ['employee', 'admin'],
            0
        );

        $question->setErrorMessage('User type %s is invalid.');

        $type = $helper->ask($input, $output, $question);

        $question = new Question('Username: ');
        $username = $helper->ask($input, $output, $question);

        $question = new Question('Password: ');
        $question->setHidden(true);
        $password = $helper->ask($input, $output, $question);

        $class = $type === 'employee' ? Employee::class : Admin::class;

        /** @var User $user */
        $user = new $class;

        $user->setUsername($username);
        $user->setPlainPassword($password);

        /** @var ConstraintViolationListInterface $foo */
        $errors = $this->getContainer()->get('validator')->validate($user);

        if ($errors) {
            $output->writeln('User with given name already exists.');
            return;
        }

        $em = $this->getContainer()->get('doctrine')->getManager();

        $em->persist($user);
        $em->flush();

        $output->writeln(sprintf('User %s created successfully.', $username));
    }
}