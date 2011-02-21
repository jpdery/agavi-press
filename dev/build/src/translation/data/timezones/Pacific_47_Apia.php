<?php

/**
 * Data file for timezone "Pacific/Apia".
 * Compiled from olson file "australasia", version 8.20.
 *
 * @package    agavi
 * @subpackage translation
 *
 * @copyright  Authors
 * @copyright  The Agavi Project
 *
 * @since      0.11.0
 *
 * @version    $Id: Pacific_47_Apia.php 4604 2010-12-12 00:29:49Z david $
 */

return array (
  'types' => 
  array (
    0 => 
    array (
      'rawOffset' => -41216,
      'dstOffset' => 0,
      'name' => 'LMT',
    ),
    1 => 
    array (
      'rawOffset' => -41400,
      'dstOffset' => 0,
      'name' => 'SAMT',
    ),
    2 => 
    array (
      'rawOffset' => -39600,
      'dstOffset' => 0,
      'name' => 'WST',
    ),
    3 => 
    array (
      'rawOffset' => -39600,
      'dstOffset' => 3600,
      'name' => 'WSDT',
    ),
  ),
  'rules' => 
  array (
    0 => 
    array (
      'time' => -2855737984,
      'type' => 0,
    ),
    1 => 
    array (
      'time' => -1861878784,
      'type' => 1,
    ),
    2 => 
    array (
      'time' => -631110600,
      'type' => 2,
    ),
    3 => 
    array (
      'time' => 1285498800,
      'type' => 3,
    ),
    4 => 
    array (
      'time' => 1301828400,
      'type' => 2,
    ),
  ),
  'finalRule' => 
  array (
    'type' => 'static',
    'name' => 'WST',
    'offset' => -39600,
    'startYear' => 2012,
  ),
  'source' => 'australasia',
  'version' => '8.20',
  'name' => 'Pacific/Apia',
);

?>