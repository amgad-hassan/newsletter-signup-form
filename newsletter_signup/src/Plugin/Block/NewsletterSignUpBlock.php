<?php

namespace Drupal\newsletter_signup\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Newsletter Sign-up Form' Block.
 *
 * @Block(
 *   id = "newsletter_signup_form_block",
 *   admin_label = @Translation("Newsletter Sign-up Form Block"),
 *   category = @Translation("Newsletter Sign-up"),
 * )
 */
class NewsletterSignUpBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('\Drupal\newsletter_signup\Form\SignupForm');

    return $form;

  }

}
