<?php

/**
 * @file
 * Contains \Drupal\custom_node\Controller\custom_nodeController.
 * description:asdfasdf;
 */

namespace Drupal\custom_node\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;


/**
 * {@inheritDoc}
 */
class nodeCreationController extends ControllerBase
{
    public function content(){
        echo "this s page";
        $node = Node::create(['type' => 'article']);
        $node->set('title','test node');
        $node->set('uid',1);
        $node->status = 1;
        $node->save();
        return array(
            '#type' => 'markup',
            '#markup' => ($nodes->title(). "has been created"),
        );
       }
}


// <?php
// namespace Drupal\custom_node\Controller;
// use Drupal\Core\Controller\ControllerBase;
// use Drupal\node\Entity\Node;
// Class CustomnodeCreation extends Controllerbase{

//  }