<?php

// +---------------------------------------------------------------------------+
// | This file is part of the AgaviPress package.                              |
// | Copyright (c) 2011-2010 the AgaviPress Project.                           |
// | Based on Agavi MVC Framework, Copyright (c) 2005-2011 the Agavi Project.  |
// |                                                                           |
// | For the full copyright and license information, please view the LICENSE   |
// | file that was distributed with this source code.                          |
// |   vi: set noexpandtab:                                                    |
// |   Local Variables:                                                        |
// |   indent-tabs-mode: t                                                     |
// |   End:                                                                    |
// +---------------------------------------------------------------------------+

namespace AgaviPress;

/**
 * The record model for configurations.
 *
 * @package    agavi-press
 * @subpackage model
 *
 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
 * @copyright  Authors
 * @copyright  The AgaviPress Project
 *
 * @since      0.1.0
 *
 * @version    0.1.0
 */
class Config extends \AgaviPressRecordModel
{
    /**
     * @var        string $name
     *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com> 
     */
    private $name;

    /**
     * @var        string $value
     *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com> 
     */
    private $value;

    /**
     * Set the name.
     *
     * @param      string $name
     *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>      
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Return the name.
     *
     * @return     string $name
     *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value.
     *
     * @param      string $value
     *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Return the value.
     *
     * @return     string $value
     *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>     
     */
    public function getValue()
    {
        return $this->value;
    }
}