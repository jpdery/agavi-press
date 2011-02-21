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

class Doctrine2Configuration extends \Doctrine\ORM\Configuration
{
	/**
	 * @var        AgaviContext The AgaviContext instance this View belongs to.
	 */
	protected $context = null;

	/**
	 * Retrieve the current application context.
	 *
	 * @return     AgaviContext The current AgaviContext instance.
	 *
	 * @author     Arran Walker <arran.walker@enixu.com>
	 */
	public final function getContext()
	{
		return $this->context;
	}

	/**
	 * Initialize Configuration providing AgaviContext.
	 *
	 * @param      AgaviContext An AgaviContext instance.
	 *
	 * @author     Arran Walker <arran.walker@enixu.com>
	 */
	public function initialize(AgaviContext $context)
	{
		$this->context = $context;
	}
}

?>