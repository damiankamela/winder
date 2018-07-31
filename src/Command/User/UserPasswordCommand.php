<?php

declare(strict_types=1);

namespace App\Command\User;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class UserPasswordCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:user:change-password')
            ->setDescription('Changes user password.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'User Password Changer',
            '============',
            '',
        ]);

        $helper = $this->getHelper('question');

        $question = new Question('Username: ');
        $username = $helper->ask($input, $output, $question);

        $userRepository = $this->getContainer()->get('doctrine')->getRepository(User::class);
        $user = $userRepository->findOneBy(compact('username'));

        if (!$user) {
            $output->writeln(sprintf('User %s not found.', $username));
            return;
        }

        $question = new Question('Password: ');
        $question->setHidden(true);
        $password = $helper->ask($input, $output, $question);

        $user->setPlainPassword($password);

        $em = $this->getContainer()->get('doctrine')->getManager();
        $em->flush();

        $output->writeln('Password changed successfully.');
    }
}