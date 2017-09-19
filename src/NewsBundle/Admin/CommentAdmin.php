<?php
namespace NewsBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollection;

class CommentAdmin extends AbstractAdmin
{
    protected $parentAssociationMapping = 'post';

    protected function configureRoutes(RouteCollection $collection)
    {
        if ($this->isChild()) {

            // This is the route configuration as a child
            $collection->clearExcept(['show', 'edit']);

            return;
        }

        // This is the route configuration as a parent
        $collection->clear();

    }
}