<?php
/**
 * Created by PhpStorm.
 * User: Poste
 * Date: 08/08/2017
 * Time: 09:49
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;


class TestAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('adresse', 'text');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('adresse');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('adresse');
    }
}