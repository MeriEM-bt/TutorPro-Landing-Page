<?php

if (!function_exists('wpbones_flags')) {

  /**
   * Helper function to return the FlagsProvider instance.
   *
   * @example
   *
   * wpbones_flags()->get('flag', 'value');
   *
   *
   * @return WPNCEasyWP\Flags\Flags
   */
  function wpbones_flags($path = '')
  {
    return new WPNCEasyWP\Flags\Flags($path);
  }
}
