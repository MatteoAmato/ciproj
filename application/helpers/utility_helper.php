<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('asset_url()'))
{
 function asset_url($file = null)
 {
   if (!is_null($file)) {
     $result = base_url().'_assets/' . $file;
   } else {
     $result = base_url().'_assets/';
   }
    return $result;
 }
}
