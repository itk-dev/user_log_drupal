<?php

/**
 * @file
 * Provide views data for itkdev_user_log module
 */

/**
 * Implements hook_views_data().
 */
function itkdev_user_log_views_data() {
  return Drupal::service('itkdev_user_log.helper')->viewsData();
}
