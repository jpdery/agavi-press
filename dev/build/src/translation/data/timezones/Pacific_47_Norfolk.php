<?php

/**
 * Data file for timezone "Pacific/Norfolk".
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
 * @version    $Id: Pacific_47_Norfolk.php 4604 2010-12-12 00:29:49Z david $
 */

return array (
  'types' => 
  array (
    0 => 
    array (
      'rawOffset' => 40320,
      'dstOffset' => 0,
      'name' => 'NMT',
    ),
    1 => 
    array (
      'rawOffset' => 41400,
      'dstOffset' => 0,
      'name' => 'NFT',
    ),
  ),
  'rules' => 
  array (
    0 => 
    array (
      'time' => -2177493112,
      'type' => 0,
    ),
    1 => 
    array (
      'time' => -599656320,
      'type' => 1,
    ),
  ),
  'finalRule' => 
  array (
    'type' => 'static',
    'name' => 'NFT',
    'offset' => 41400,
    'startYear' => 1951,
  ),
  'source' => 'australasia',
  'version' => '8.20',
  'name' => 'Pacific/Norfolk',
);

?>