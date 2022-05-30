<?php

namespace Drupal\vehicle\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class VehicleSettingsForm.
 */
class VehicleSettingsForm extends FormBase {
  /**
   * Get From ID.
   */
  public function getFormId() {
    return 'vehicle_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['vehicle_settings']['#markup'] = 'Settings form for Vehicle. Manage field settings here.';
    return $form;
  }

}
