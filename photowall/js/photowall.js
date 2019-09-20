/**
 * @file
 * Defines Javascript behaviors for the photowall module.
 */

(function ($, Drupal, drupalSettings) {

  'use strict';

  /**
   * JS required for photowall.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attach behavior for photowall.
   */
  Drupal.behaviors.photowall = {
    attach: function (context, settings) {
      var photowall = drupalSettings.settings.photowall;
      var entity_id = drupalSettings.settings.entity_id;
      var entity_type = drupalSettings.settings.entity_type;
      $('.photowall-element').each(function() {
        if ($(this).hasClass('photowall-' + entity_type + '-' + entity_id)) {
          console.log(this);
          PhotoWall.init({
            el: '.photowall-' + entity_type + '-' + entity_id,  // Gallery element.
            zoom: true,  // Use zoom.
            zoomAction: 'mouseenter',  // Zoom on action.
            zoomTimeout: 500,  // Timeout before zoom.
            zoomImageBorder: 5,  // Zoomed image border size.
            zoomDuration: 100,  // Zoom duration time.
            showBox: true, // Enable fullscreen mode.
            showBoxSocial: true,  // Show social buttons.
            padding: 5,  // padding between images in gallery.
            lineMaxHeight: 150, // Max set height of pictures line
            lineMaxHeightDynamic: false,  // Dynamic lineMaxHeight.
            baseScreenHeight: 600  // Base screen size from wich calculating dynamic lineMaxHeight.
          });
          PhotoWall.load(photowall);
        }
      });
    }
  }
})(jQuery, Drupal, drupalSettings);
