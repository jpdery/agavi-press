<?php

// +---------------------------------------------------------------------------+
// | This file is part of the Agavi package.                                   |
// | Copyright (c) 2005-2010 the Agavi Project.                                |
// |                                                                           |
// | For the full copyright and license information, please view the LICENSE   |
// | file that was distributed with this source code. You can also view the    |
// | LICENSE file online at http://www.agavi.org/LICENSE.txt                   |
// |   vi: set noexpandtab:                                                    |
// |   Local Variables:                                                        |
// |   indent-tabs-mode: t                                                     |
// |   End:                                                                    |
// +---------------------------------------------------------------------------+

/**
 * bootstrap file for the AgaviTesting
 *
 * @package    agavi
 * @subpackage testing
 *
 * @author     Felix Gilcher <felix.gilcher@bitextender.com>
 * @copyright  The Agavi Project
 *
 * @since      1.0.0
 *
 * @version    $Id: testing.php 4604 2010-12-12 00:29:49Z david $
 */

$here = realpath(dirname(__FILE__));

// load Agavi basics
require_once($here . '/agavi.php');

// AgaviTesting class
require_once($here . '/testing/AgaviTesting.class.php');

// load PHPUnit basics
require_once 'PHPUnit/Util/Getopt.php';
require_once('PHPUnit/TextUI/TestRunner.php');

?>