<?php

namespace Drupal\newsletter_signup\Form;

use Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Provides a form for deleting a newsletter_signup entity.
 *
 * @ingroup newsletter_signup
 */
class SubscriptionDeleteForm extends ContentEntityConfirmFormBase {

  /**
   * Returns the question to ask the user.
   *
   * @return string
   *   The form question. The page title will be set to this value.
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete %name?', ['%name' => $this->entity->label()]);
  }

  /**
   * Returns the route to go to if the user cancels the action.
   *
   * @return \Drupal\Core\Url
   *   A URL object.
   */
  public function getCancelUrl() {
    return new Url('entity.newsletter_signup_subscription.collection');
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   *
   * Delete the entity and log the event. logger() replaces the watchdog.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $entity->delete();

    $this->logger('newsletter_signup')->notice('deleted %title.',
      [
        '%title' => $this->entity->label(),
      ]);
    // Redirect to term list after delete.
    $form_state->setRedirect('entity.newsletter_signup_subscription.collection');
  }

}
