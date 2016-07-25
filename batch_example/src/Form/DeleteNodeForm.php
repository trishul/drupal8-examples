<?php

namespace Drupal\batch_example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class DeleteNodeForm.
 *
 * @package Drupal\batch_example\Form
 */
class DeleteNodeForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'delete_node_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['delete_node'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Delete Node'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $entities = \Drupal::entityTypeManager()
      ->getStorage('node')
      ->loadMultiple();

    $batch = array(
      'title' => t('Deleting Node...'),
      'operations' => array(
        array(
          '\Drupal\batch_example\DeleteNode::deleteNodeExample',
          array($entities)
        ),
      ),
      'finished' => '\Drupal\batch_example\DeleteNode::deleteNodeExampleFinishedCallback',
    );

    batch_set($batch);
  }

}
