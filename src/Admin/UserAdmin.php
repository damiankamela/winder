<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Admin;
use App\Entity\Employee;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserAdmin extends AbstractAdmin
{
    public function configure()
    {
        $this->setSubClasses([
            'admin' => Admin::class,
            'employee' => Employee::class
        ]);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('email', TextType::class)
            ->add('plainPassword', PasswordType::class, [
                'required' => false
            ])
            ->add('isActive')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('email')
            ->add('isActive')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('email')
            ->add('isActive')
            ->add(
                '_action',
                null,
                [
                    'actions' => [
                        'show' => [],
                    ],
                ]
            )
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('email')
            ->add('isActive')
        ;
    }
}