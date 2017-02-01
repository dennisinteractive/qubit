<?php

namespace Drupal\qubit\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class QubitSettingsForm.
 *
 * @package Drupal\qubit\Form
 */
class QubitSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'qubit.qubitsettings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'qubit_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('qubit.qubitsettings');
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
    $this->config('qubit.qubitsettings')
      ->set('customer_id', $form_state->getValue('customer_id'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
