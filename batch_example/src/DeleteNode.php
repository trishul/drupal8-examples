<?php

namespace Drupal\batch_example;


class DeleteNode {

  public static function deleteNodeExample($entities, &$context){
    $message = 'Deleting Node...';
    $results = array();
    foreach ($entities as $entity) {
      $results[] = \Drupal::entityTypeManager()
        ->getStorage('node')->delete($entity);
    }
    $context['message'] = $message;
    $context['results'] = $results;
  }

  function deleteNodeExampleFinishedCallback($success, $results, $operations) {
    // The 'success' parameter means no fatal PHP errors were detected. All
    // other error management should be handled using 'results'.
    if ($success) {
      $message = \Drupal::translation()->formatPlural(
        count($results),
        'One post processed.', '@count posts processed.'
      );
    }
    else {
      $message = t('Finished with an error.');
    }
    drupal_set_message($message);
  }
}