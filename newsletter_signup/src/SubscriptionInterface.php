<?php

namespace Drupal\newsletter_signup;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a subscription entity.
 */
interface SubscriptionInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
