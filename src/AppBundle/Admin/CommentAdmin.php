<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class CommentAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'comment';
    protected $parentAssociationMapping = 'post';

//    protected function configureRoutes(RouteCollection $collection)
//    {
//        if ($this->isChild()) {
//
//            // This is the route configuration as a child
//            $collection->clearExcept(['show', 'edit']);
//
//            return;
//        }
//
//        // This is the route configuration as a parent
//        $collection->clear();
//
//    }
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        if(!$this->isChild()) {
            $formMapper->add('post', 'sonata_type_model');
        }

        $formMapper
            ->add('name')
            ->add('email')
            ->add('url', null, array('required' => false))
            ->add('message')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('email')
            ->add('message')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('post')
            ->add('email')
            ->add('url')
            ->add('message');
    }

    /**
     * @return array
     */
    public function getBatchActions()
    {
        $actions = parent::getBatchActions();

        $actions['enabled'] = array(
            'label' => $this->trans('batch_enable_comments'),
            'ask_confirmation' => true,
        );

        $actions['disabled'] = array(
            'label' => $this->trans('batch_disable_comments'),
            'ask_confirmation' => false
        );

        return $actions;
    }
}