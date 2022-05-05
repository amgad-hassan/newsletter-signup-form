<?php

namespace Drupal\newsletter_signup\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Provides a sign-up form.
 */
class SignupForm extends FormBase
{

  /**
   * Returns a unique string identifying the form.
   *
   * The returned ID should be a unique string that can be a valid PHP function
   * name, since it's used in hook implementation names such as
   * hook_form_FORM_ID_alter().
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId()
  {
    return 'newsletter_signup_form';
  }

  /**
   * Form constructor.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   The form structure.
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {

    $form['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First Name'),
      '#description' => $this->t('Please enter your first name.Note your first name is required'),
      '#required' => TRUE,
    ];

    $form['last_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last Name'),
      '#description' => $this->t('Please enter your last name.Note your last name is required'),
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#description' => $this->t('Please enter your email.Note your email is required'),
      '#required' => TRUE,
    ];

    $form['country'] = [
      '#type' => 'select',
      '#title' => t('Country'),
      '#options' => [
        'Australia' => t('Australia'),
        'Argentina' => t('Argentina'),
        'Belgium' => t('Belgium'),
        'Brazil' => t('Brazil'),
        'Cambodia' => t('Cambodia'),
        'Denmark' => t('Denmark'),
        'Egypt' => t('Egypt'),
        'Finland' => t('Finland'),
      ],
    ];

    $form['terms'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('I agree to the terms and conditions of the newsletter'),
      '#required' => TRUE,
    ];
    
    $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#button_type' => 'primary',
      '#default_value' => $this->t('Submit') ,
    ];


    return $form;
  }

  /**
   * Validate the title and the checkbox of the form
   * 
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   * 
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    parent::validateForm($form, $form_state);
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    
    $first_name = $form_state->getValue('first_name');
    $last_name =  $form_state->getValue('last_name');
    $email=  $form_state->getValue('email');
    $country=  $form_state->getValue('country');
    $terms =  $form_state->getValue('terms'); 
    try {
      $subscription =  \Drupal::entityTypeManager()->getStorage('newsletter_signup_subscription')
        ->create([
          'first_name' => $first_name,
          'last_name' => $last_name,
          'email' => $email,
          'country' => $country,
          'terms' => $terms, 
        ]);
      $subscription->save();
      \Drupal::messenger()->addMessage($this->t('Thank you for submitting to the newsletter'));
  
    } catch (\Exception $ex) {
      \Drupal::logger('newsletter_signup')->error($ex->getMessage());
    }
  }
}

