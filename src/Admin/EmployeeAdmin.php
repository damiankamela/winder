<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class EmployeeAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('email')
            ->add('firstName')
            ->add('lastName')
            ->add('phone')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('email')
            ->add('firstName')
            ->add('lastName')
            ->add('phone')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('email')
            ->add('firstName')
            ->add('lastName')
            ->add('phone')
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
            ->tab('General')
                ->add('email')
                ->add('firstName')
                ->add('lastName')
                ->add('phone')
                ->end()
            ->end()
            ->tab('Projects')
                ->add('projects', null, ['route'=> ['name'=>'show']])
            ->end()
        ;
    }
}