<?php
// use \Drupal\Core\Database\Database;

/**
 * Implement hook_drush_commands()
 */

  function custom_drush_drush_command(){

    $commands = array();

    $commands['testing_demo'] = [
      'description' => 'my first custom command',
      'aliases' => ['testing_demo'],
    ];

    $commands['get_nodes'] = [
      'description' => 'get top 5 list nodes',
      'arguments' => [
        'type' => 'get latest 5 nodes of this type',
      ],
      'aliases' => ['nodes'],
      'examples' =>[' drush get_nodes content-type'],
    ];

    return $commands;

}

/**
 * Callback for the get_nodes command.
 */
function drush_custom_drush_get_nodes() {

  $args = func_get_args();

  if ($args) {
    // $nids = \Drupal::service('entity.query')->get('node_field_data')->condition('type',$args)->execute();
    // $nodes =  \Drupal\node\Entity\Node::loadMultiple($nids);
    // foreach ($nids as $node) {

    //   drush_print($node);
    // }

    $result1 = \Drupal::database()->select('node_field_data', 'n')
    ->fields('n', array('title'))
    ->condition('type',$args,'')
    ->orderBy('created', 'DESC')
    ->execute()
    ->fetchAllKeyed(0,0);
    foreach ($result1 as $value) {
        # code...
        drush_print($value);
     }
      // Query to get count of particular type
       $result = \Drupal::database()->select('node_field_data', 'n')
      ->fields('n', array('title'))
      ->condition('type',$args,'')
      ->countQuery()
      ->execute()
      ->fetchObject();
    $num_of_results = $result->expression;
      drush_print($args[0]. "'s node count : " . $num_of_results);

  }
  else{
    drush_print('no arguments specified, use --help');
  }

}

/**
* implement drush_{moudle_name}_{item_id_for_commmand}() */


function drush_custom_drush_testing_demo() {
  drush_print('Welcome to Drush Interface');
}
