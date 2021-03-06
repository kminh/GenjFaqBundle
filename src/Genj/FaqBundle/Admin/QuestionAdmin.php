<?php

namespace Genj\FaqBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

use Genj\FaqBundle\Entity\Category;

/**
 * Class QuestionAdmin
 *
 * @package Genj\FaqBundle\Admin
 */
class QuestionAdmin extends Admin
{
    protected $translationDomain = 'GenjFaqBundle';

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_by' => 'rank',
        '_sort_order' => 'Asc'
    );

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('headline')
            ->add('body')
            ->add('category')
            ->add('slug');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('headline', null, array('identifier' => true))
            ->add('category')
            ->add('rank')
            ->add('_action', 'actions',
                array(
                    'actions' => array(
                        'show' => array(),
                        'edit' => array(),
                        'delete' => array()
                    )
                )
            );
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Basics', array('class' => 'col-md-8'))
            ->add('headline', null, array('attr' => array('class' => 'span12')))
            ->add('body', 'ckeditor', array('required' => false, 'attr' => array('class' => 'span12')))
            ->end()

            ->with('Status', array('class' => 'col-md-4'))
            ->add('category', 'sonata_type_model', array(
                    'expanded' => true,
                    'required' => true,
                    'attr' => array('class' => 'radio-list vertical')
            ))
            ->add('rank', null, array('required' => false, 'attr' => array('class' => 'span12')))
            ->add('slug', null, array('required' => false, 'attr' => array('class' => 'span12')))
            ->end();
    }
}
