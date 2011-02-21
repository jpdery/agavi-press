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

/**
 * This this the model all future manager model will inherit. Manager models 
 * are use to perform create, update, retrieve and delete tasks.
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
abstract class AgaviPressManagerModel extends AgaviPressModel implements AgaviISingletonModel
{
	/**
	 * @var        \Doctrine\ORM\EntityManager The entity manager.
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>	 
	 */
	protected $entityManager = null;
	
	/**
	 * @var        array Default query builder parameter values.
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>	 
	 */
	protected $queryParametersDefault = array(
		'paged' => false,
		'page_number' => 0,
		'page_length' => 0,
		'limit' => 0,
		'offset' => 0,
		'include' => null,
		'exclude' => null,
		'order' => null
	);
	
	/**
	 * @var        array Default query builder parameter values per manager.
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>	 
	 */	
	protected $queryParameters = array();
	
	/**
	 * Initialize this model. Also set a reference of the entity manager
	 * to the $entityManager property.
	 *
	 * @param      AgaviContext The current application context.
	 * @param      array Initialization parameters.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	public function initialize(AgaviContext $context, array $parameters = array())
	{
		parent::initialize($context);
		
		$this->entityManager = $this->context->getDatabaseManager()->getDatabase()->getEntityManager();
	}
	
	/**
	 * Returns all records.
	 *
	 * @return	   array All records.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0		 
	 */	
	public function findAll()
	{
		$t = $this->getTableName();

		return $this->entityManager->getRepository($t)->findAll();
	}
	
	/**
	 * Return the record with the given index.
	 *
	 * @param      int The index value.
	 *
	 * @return     object The record.
	 *
	 * @throws     AgaviPressNoRecordException If the record cannot be found.
	 *	
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */	
	public function findOneByIndex($value)
	{
		$t = $this->getTableName();
		$i = $this->getIndexName();
				
		$record = $this->entityManager->getRepository($t)->find($i, $value);
		if ($record === false || $record === null) {
			throw new AgaviPressNoRecordException();
		}
		
		return $record;
	}

	/**
	 * Returns the first record that matches the field's value.
	 *
	 * @param      string The field name to search with.
	 * @param      mixed The value to search for.
	 *
	 * @return     object The record.
	 *
	 * @throws     AgaviPressNoRecordException If the record cannot be found.
	 *	
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	public function findOneByField($field, $value)
	{
		$t = $this->getTableName();
		
		$record = $this->entityManager->getRepository($t)->findOneBy($field, $value);
		if ($record === false || $record === null) {
			throw new AgaviPressNoRecordException();
		}
	
		return $record;
	}
	
	/**
	 * Returns the number of records in the table.
	 *
	 * @return     int The number of records in the table.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0	 
	 */
	public function count()
	{
		$t = $this->getTableName();
		$i = $this->getIndexName();
		
		return $this->createQuery("SELECT COUNT(t.$i) FROM $t t")->getSingleScalarResult();
	}	
	
	/**
	 * Create a query using the entity manager. This is just a convenient shortcut
	 * for $this->entityManager->createQuery.
	 *
	 * @param      string The DQL query.
	 
	 * @return     Doctrine\ORM\Query A Query object represents a DQL query.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0	 
	 */	
	protected function createQuery($query)
	{
		return $this->entityManager->createQuery($query);
	}

	/**
	 * Create a QueryBuilder instance populate with parameters. This is a convenient
	 * shortcut for $this->entityManager->createQueryBuilder.
	 *
	 * @param      mixed An array of parameter or a query string. The default set
	 *                   of parameters consist in:
	 *                   paged       (bool) Whether or not the query is paged.
	 *                   page_number (int)  The page index to display.
	 *                   page_length (int)  The page ammount of results.
	 *                   limit       (int)  The limit clause.
	 *                   offset      (int)  The offset clause.
	 *                   include     (string) Comma separated indexes to include.
	 *                   exclude     (string) Comma separated indexes to exclude.
	 *
	 * @return     Doctrine\ORM\QueryBuilder The populated query builder instance.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0	 
	 */	
	protected function createQueryBuilder($parameters = '')
	{
		if (is_string($parameters)) {
			parse_str($parameters, $parameters);
		}
		
		extract(array_merge($this->queryParametersDefault, $this->queryParameters, $parameters));
	
		$queryBuilder = $this->entityManager->createQueryBuilder();
		
		if ($paged) {
			$offset = $page_length * ($page_number - 1);
			$limit = $page_length;
		}
			
		if ($offset) $queryBuilder->setFirstResult($offset);
		if ($limit) $queryBuilder->setMaxResults($limit);
		
		if ($order) {
			$orders = explode(',', $order);
			foreach ($orders as $order) {
				$order = trim($order);
				$order = explode(' ', $order);
				$field = $order[0];
				$order = isset($order[1]) ? $order[1] : 'asc';
				$queryBuilder->addOrderBy($field, $order);
			}
		}

		if ($include) {
			$where = sprintf('%s IN (:include)', $this->getIndexName());
			$queryBuilder->addWhere($where);
			$queryBuilder->setParameter('include', $include);
		}
		
		if ($exclude) {
			$where = sprintf('%s NOT IN (:include)', $this->getIndexName());
			$queryBuilder->addWhere($where);
			$queryBuilder->setParameter('exclude', $exclude);
		}
		
		return $queryBuilder;		
	}
	
	/**
	 * A convenient shortcut for $this->entityManager->persist().
	 *
	 * @param      AgaviPressRecordModel The record model to persist.
	 * 
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	protected function persist(AgaviPressRecordModel $record)
	{
		$this->entityManager->persist($record);	
	}
	
	/**
	 * A convenient shortcut for $this->entityManager->flush().
	 * 
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */	
	protected function flush()
	{
		$this->entityManager->flush();
	}	
	
	/**
	 * The doctrine php name of the table this model acts upon. 
	 *
	 * @return      string The table name.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0
	 */
	abstract protected function getTableName();
	
	/**
	 * The field that serves as the primary index.
	 *
	 * @return     string The index name.
	 *
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
	 * @since      0.1.0 
	 */
	abstract protected function getIndexName();	
	
}