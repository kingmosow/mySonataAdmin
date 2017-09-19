<?php
/**
 * Created by PhpStorm.
 * User: Poste
 * Date: 08/08/2017
 * Time: 09:05
 */

namespace AppBundle\Admin;

use AppBundle\Entity\TestOneToOne;
use AppBundle\Form\TestOneToOneType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BlogPostAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                    ->add('title', 'text')
                    ->add('body', 'textarea')
                    ->add('category', 'sonata_type_model_autocomplete',array(
                            'property' => 'name'
                        )
                    )
                    ->add('test', 'sonata_type_admin')

//                    ->add('test', new TestOneToOneType('TextType::class'))
                ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title')
                    ->addIdentifier('body')
                    ->addIdentifier('category.name')
                    ->addIdentifier('test.adresse');
    }
}