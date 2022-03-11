<?php

/**
 * @file
 * Theming functions for the Photowall module.
 */

use Drupal\Component\Serialization\Json;

/**
 * Template preprocess handler for 'photowall' theme.
 */
function photowall_preprocess_photowall(&$variables) {
  // Add JQuery plugin and JS.
  $variables['#attached']['library'][] = 'photowall/init';
  $variables['#attached']['library'][] = 'photowall/photowall';
  // Set entity_type and entity_id to the variables.
  $entity_type = Json::decode($variables['photowall_options']);
  $variables['entity_type'] = $entity_type['entity_type'];
  $variables['entity_id'] = $entity_type['entity_id'];
  $variables['target_id'] = $entity_type['target_id'];
}
