<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\DatePickerType;
use Sonata\CoreBundle\Form\Type\DateRangePickerType;
use Sonata\DoctrineORMAdminBundle\Filter\DateRangeFilter;

class ProjectAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('turbine')
            ->add('startDate', DatePickerType::class, [
                'format' => 'YYYY-MM-DD'
            ])
            ->add('endDate', DatePickerType::class, [
                'format' => 'YYYY-MM-DD'
            ])
            ->add('employees', null, [
                'multiple' => true
            ])
        ;
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('turbine')
            ->add('startDate', DateRangeFilter::class, [
                'field_type' => DateRangePickerType::class,
                'field_options' => [
                    'field_options_start' => ['format' => 'YYYY-MM-DD'],
                    'field_options_end' => ['format' => 'YYYY-MM-DD'],
                ],
            ])
            ->add('endDate', DateRangeFilter::class, [
                'field_type' => DateRangePickerType::class,
                'field_options' => [
                    'field_options_start' => ['format' => 'YYYY-MM-DD'],
                    'field_options_end' => ['format' => 'YYYY-MM-DD'],
                ],
            ])
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('turbine')
            ->add('startDate', null, [
                'format' => 'Y-m-d'
            ])
            ->add('endDate', null, [
                'format' => 'Y-m-d'
            ])
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
            ->add('turbine', null, ['route'=> ['name'=>'show']])
            ->add('startDate', null)
            ->add('endDate', null)
            ->add('employees', null, ['route'=> ['name'=>'show']])
        ;
    }
}