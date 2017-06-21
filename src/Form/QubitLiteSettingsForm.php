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

    $form['site_id'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Site Id'),
      '#default_value' => $config->get('site_id'),
    );

    $form['biscotti'] = array(
      '#type' => 'fieldset',
      '#title' => $this->t('Biscotti settings'),
    );

    $form['biscotti']['biscotti_url'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Biscotti url'),
      '#default_value' => $config->get('biscotti_url'),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE,
    );

    $form['biscotti']['biscotti_safe_domains'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Safe domains'),
      '#default_value' => $config->get('biscotti_safe_domains'),
      '#description' => $this->t('Add one domain per line'),
      '#required' => TRUE,
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
      ->set('site_id', $form_state->getValue('site_id'))
      ->set('biscotti_url', $form_state->getValue('biscotti_url'))
      ->set('biscotti_safe_domains', $form_state->getValue('biscotti_safe_domains'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
