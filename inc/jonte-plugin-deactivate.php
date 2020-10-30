<?php
/**
 * @package JontePlugin
 */

 class JontePluginDeactivate
 {
     public static function deactivate() {
         flush_rewrite_rules();
     }
 }