<?php

namespace Genj\FaqBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;

use Genj\FaqBundle\Admin\QuestionAdmin as Admin;

/**
 * @author Khang Minh <kminh@kdmlabs.com>
 */
class CategoryAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        // Custom admin routes, can use: add(), remove(), clearExcept(), getRouterIdParameter()
        parent::configureRoutes($collection);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        // Fields to be shown on create/edit forms
        parent::configureFormFields($formMapper);

        $formMapper
            ->with('Status')
                ->add('isActive', 'checkbox', ['required' => false])
            ->end()
            ->remove('category')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        // Fields to be shown on filter forms
        $datagridMapper
            ->add('headline')
            ->add('body')
            ->add('slug')
            ->add('isActive');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        // Fields to be shown when listing items
        parent::configureListFields($listMapper);

        $listMapper
            ->add('isActive')
            ->remove('category')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        // Fields to be shown when viewing an item
        parent::configureShowFields($showMapper);
    }
}
