<?php
// src/AppBundle/Admin/PostAdmin.php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Knp\Menu\ItemInterface as MenuItemInterface;

class PostAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'ppost';
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text', array(
                'label' => 'Post Title'
            ))
            ->add('content', 'text')
            ->add('abstract', 'text')
            ->add('enabled', 'choice',
                array(
                    'choices' => array(
                        'False' => '0',
                        'True' => '1'
                    )
//              ,array(
//                    'class'       => 'col-md-8',
//                    'box_class'   => 'box box-solid box-danger',
//                    'description' => 'Lorem ipsum'
//                    // ...
//                )
                ))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('content')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->addIdentifier('content')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'comments' => array('template' => 'post_comments.html.twig')
                )
            ))
        ;
    }

    // Fields to be shown on show action
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('content')
        ;
    }

    public function getDashboardActions()
    {
        $actions = parent::getDashboardActions();

        unset($actions['list']);

        return $actions;
    }
    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, array('edit', 'show'))) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;
        $id = $admin->getRequest()->get('id');

        $menu->addChild('View Comment', array('uri' => $admin->generateUrl('show', array('id' => $id))));

        if ($this->isGranted('EDIT')) {
            $menu->addChild('Edit Comment', array('uri' => $admin->generateUrl('edit', array('id' => $id))));
        }

        if ($this->isGranted('LIST')) {
            $menu->addChild('Manage Comment', array(
                'uri' => $admin->getChild('admin.comment')->generateUrl('list', array('id' => $id))
            ));
        }
    }
}