<?php
/**
 * @package JontePlugin
 */

 class JontePluginActivate
 {
     public static function activate() {
         flush_rewrite_rules();
     }
 }