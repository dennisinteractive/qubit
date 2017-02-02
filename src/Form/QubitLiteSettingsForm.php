<?php

namespace Drupal\qubit_lite\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class QubitSettingsForm.
 *
 * @package Drupal\qubit\Form
 */
class QubitLiteSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'qubit_lite.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'qubit_lite_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('qubit_lite.settings');
    $form['customer_id'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Customer Id'),
      '#default_value' => $config->get('customer_id'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('qubit_lite.settings')
      ->set('customer_id', $form_state->getValue('customer_id'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
