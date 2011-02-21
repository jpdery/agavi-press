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

class Doctrine2ContextEventListener
{
	public function postLoad(\Doctrine\ORM\Event\LifecycleEventArgs $eventArgs)
	{
		if ($eventArgs->getEntity() instanceof \AgaviIModel) {
			$eventArgs->getEntity()->initialize($eventArgs->getEntityManager()->getConfiguration()->getContext());
		}
	}
}

?>