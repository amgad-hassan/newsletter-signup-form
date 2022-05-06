<?php

namespace Drupal\newsletter_signup;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

/**
 * Provides a list controller for newsletter_signup_subscription entity.
 *
 * @ingroup newsletter_signup
 */
class SubscriptionListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   *
   * We override ::render() so that we can add our own content above the table.
   * parent::render() is where EntityListBuilder creates the table using our
   * buildHeader() and buildRow() implementations.
   */
  public function render() {
    $build['description'] = [
      '#markup' => $this->t('These subscriptions are fieldable entities. You can manage the fields on the <a href="@adminlink">subscriptions admin page</a>.', [
        '@adminlink' => Url::fromRoute('newsletter_signup.subscription_settings', [], ['absolute' => 'true'])->toString(),
      ]),
    ];

    $build += parent::render();
    return $build;
  }

  /**
   * {@inheritdoc}
   *
   * Building the header and content lines for the subscription list.
   *
   * Calling the parent::buildHeader() adds a column for the possible actions
   * and inserts the 'edit' and 'delete' links as defined for the entity type.
   */
  public function buildHeader() {
    $header['id'] = $this->t('SubscriptionID');
    $header['first_name'] = $this->t('First Name');
    $header['last_name'] = $this->t('Last Name');
    $header['email'] = $this->t('Email');
    $header['country'] = $this->t('Country');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /** @var \Drupal\newsletter_signup\Entity\subscription $entity */
    $row['id'] = $entity->id();
    $row['first_name'] = $entity->first_name->value;
    $row['last_name'] = $entity->last_name->value;
    $row['email'] = $entity->email->value;
    $row['country'] = $entity->country->value;
    return $row + parent::buildRow($entity);
  }

}
