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

class Doctrine2Database extends AgaviDatabase
{
	protected $em = null;

	public function connect()
	{
		// Not required, Doctrine connects when required. Like a boss.
	}

	public function shutdown()
	{
		if ($this->em->getUnitOfWork()->size()) {
			$this->em->flush();
		}
	}

	public function getEntityManager()
	{
		return $this->em;
	}

	public function initialize(AgaviDatabaseManager $databaseManager, array $parameters = array())
	{
		parent::initialize($databaseManager, $parameters);

		// Doctrine autoload
		$classLoader = new \Doctrine\Common\ClassLoader('Doctrine\ORM', $parameters['orm_path']);
		$classLoader->register();

		$classLoader = new \Doctrine\Common\ClassLoader('Doctrine\DBAL', $parameters['dbal_path']);
		$classLoader->register();

		$classLoader = new \Doctrine\Common\ClassLoader('Doctrine\Common', $parameters['common_path']);
		$classLoader->register();

		$classLoader = new \Doctrine\Common\ClassLoader($parameters['proxy_namespace'], $parameters['proxy_path']);
		$classLoader->register();

		$config = new Doctrine2Configuration();
		$config->initialize($databaseManager->getContext());

		if (!AgaviConfig::get('core.debug')) {
			$config->setMetadataCacheImpl(new Doctrine\Common\Cache\ApcCache());
			$config->setQueryCacheImpl(new Doctrine\Common\Cache\ApcCache());
		}

		$driver = new \Doctrine\ORM\Mapping\Driver\XmlDriver(array($parameters['xml_mapping_path']));
		$config->setMetadataDriverImpl($driver);

		$config->setProxyDir($parameters['proxy_path'] . '/' . str_replace('\\', '_', $parameters['proxy_namespace']));
		$config->setProxyNamespace($parameters['proxy_namespace']);

		$connectionParams = array(
			'dbname'   => $parameters['database'],
			'user'     => $parameters['username'],
			'password' => $parameters['password'],
			'host'     => $parameters['hostname'],
			'driver'   => $parameters['driver']
		);

		$evm = new \Doctrine\Common\EventManager();
		$evm->addEventSubscriber(new \Doctrine\DBAL\Event\Listeners\MysqlSessionInit($this->getParameter('charset')));
		$evm->addEventListener(array(Doctrine\ORM\Events::postLoad), new Doctrine2ContextEventListener());

		$this->em = \Doctrine\ORM\EntityManager::create($connectionParams, $config, $evm);
	}
}

?>