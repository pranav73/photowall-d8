/**
 * @file
 * Defines Javascript behaviors for the photowall.
 */

(function ($, Drupal, drupalSettings) {

  'use strict';

  /**
   * Photowall initialization.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attach behavior for photowall.
   */
  Drupal.behaviors.photowall = {
    attach: function (context, settings) {
      $('.photowall').each(function (i) {
        // Get the photowall settings.
        var pwSettings = $(this).attr("data-photowall-settings");
        // Parse settings.
        var photowallSettings = JSON.parse(decodeURIComponent(pwSettings));
        // Get required photowall options.
        var pwOptions = $(this).attr("data-photowall-options");
        var photowallOptions = JSON.parse(decodeURIComponent(pwOptions));

        // Prepare element selector.
        var el = '.photowall-' + photowallOptions.entity_type + '-' + photowallOptions.entity_id + '-' + photowallOptions.target_id;
        var classes = '.photowall-' + photowallOptions.entity_type;
        PhotoWall.init({
          classes: classes,
          el: el,  // Gallery element.
          zoom: true,  // Use zoom.
          zoomAction: 'mouseenter',  // Zoom on action.
          zoomTimeout: 500,  // Timeout before zoom.
          zoomImageBorder: 5,  // Zoomed image border size.
          zoomDuration: 100,  // Zoom duration time.
          showBox: true, // Enable fullscreen mode.
          showBoxSocial: false,  // Hide social buttons.
          padding: 5,  // padding between images in gallery.
          lineMaxHeight: 150, // Max set height of pictures line
          lineMaxHeightDynamic: false,  // Dynamic lineMaxHeight.
          baseScreenHeight: 600  // Base screen size from wich calculating dynamic lineMaxHeight.
        });
        PhotoWall.load(photowallSettings);
      });
    }
  }
})(jQuery, Drupal, drupalSettings);
