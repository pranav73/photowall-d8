CONTENTS OF THIS FILE
---------------------
 * Introduction
 * Requirements
 * Installation
 * Configuration
 * Available options
 * Maintainers


INTRODUCTION
------------
Provides a Photowall format for displaying Image field, using the
JQuery Photowall plugin.

The Photowall plugin was originally developed from https://github.com/creotiv


REQUIREMENTS
------------
This module requires libraries module https://www.drupal.org/project/libraries
and jquery-photowall library https://github.com/tanmayk/jquery-photowall/tree/3.x.


INSTALLATION
------------
* Download the module and place in contrib module folder.
* Download the zip containing JQuery Photowall plugin given below :
  https://github.com/tanmayk/jquery-photowall/tree/3.x
* Put jquery-photowall library into /libraries folder so jquery-photowall.js
  can be found at /libraries/jquery-photowall/lib/jquery-photowall.js
* Enable the Photowall module from the, modules page / drush / drupal console.
* You should now see a new field formatter i.e. "Photowall" for image fields,
  Ex: under Manage display section of each content types.


CONFIGURATION
-------------
* Visit any image fields display settings, you will be able to find
the Photowall formatter.
Ex: admin/structure/types/manage/<content-type-machine-name>/display
* Click the settings wheel in the slideshow-formatted multiple image/media
field to edit advanced settings.
* Add content & upload 1 or more than 1 images to the node and Save..
On node view, Photowall effect will appear for that image field.

AVAILABLE OPTIONS
-----------------
* Zoom Factor : Set zoom factor between 1.3 to 1.6 for better results.

MAINTAINERS
-----------

 * Tanmay Khedekar
     - https://www.drupal.org/u/tanmayk
 * Pranav Aeer
     - https://www.drupal.org/u/pranav73
 * Revati Gawas
     - https://www.drupal.org/u/revati_gawas
