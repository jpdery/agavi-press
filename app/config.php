<?php

// +---------------------------------------------------------------------------+
// | An absolute filesystem path to the project root directory.                |
// +---------------------------------------------------------------------------+
AgaviConfig::set('core.project_dir', realpath(dirname(__FILE__) . '/../'));

// +---------------------------------------------------------------------------+
// | An absolute filesystem path to your web application directory.            |
// +---------------------------------------------------------------------------+
AgaviConfig::set('core.app_dir', AgaviConfig::get('core.project_dir') . '/app');

// +---------------------------------------------------------------------------+
// | An absolute filesystem path for the 3rd party libraries directory.        |
// +---------------------------------------------------------------------------+
AgaviConfig::set('core.vendor_dir', AgaviConfig::get('core.project_dir') . '/vendor');

// +---------------------------------------------------------------------------+
// | An absolute filesystem path to the customization directory.               |
// +---------------------------------------------------------------------------+
AgaviConfig::set('core.custom_dir', AgaviConfig::get('core.project_dir') . '/custom');

?>