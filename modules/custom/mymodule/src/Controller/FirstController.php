<?php

/**
 * @file
 * Contains \Drupal\mymodule\Controller\MyModuleController.
 * description:asdfasdf;
 */

namespace Drupal\mymodule\Controller;

use Drupal\Core\Controller\ControllerBase;


/**
 * {@inheritDoc}
 */
class FirstController extends ControllerBase
{
    public function content()
    {
        return[
            '#theme' => 'mymodule_theme',
            '#title' => $this->t('hello there'),
            '#description' => $this->t('this is coming from custom twig'),
        ];
    }
}
