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

namespace AgaviPress;

/**
 * AgaviPress\Page
 */
class Page extends \AgaviPressRecordModel
{
    /**
     * @var        int $id
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $id;

    /**
     * @var        int $authorId
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $authorId;

	/**
     * @var        AgaviPress\User
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $author;

    /**
     * @var        int $parentId
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $parentId;

	/**
     * @var        AgaviPress\Page
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $parent;

    /**
     * @var        string $name
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $name;

    /**
     * @var        string $status
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $status = 'draft';

    /**
     * @var        boolean $secure
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $secure = false;

    /**
     * @var        string $credential
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $credential = null;

    /**
     * @var        string $boundTo
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $boundTo = 'content';

    /**
     * @var        string $boundToTemplate
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $boundToTemplate;

    /**
     * @var        string $boundToModule
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $boundToModule;

    /**
     * @var        string $boundToAction
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $boundToAction;

    /**
     * @var        datetime $createdAt
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $createdAt;

    /**
     * @var        datetime $updatedAt
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $updatedAt;

    /**
     * @var AgaviPress\PageTranslation
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $translations;

    public function __construct()
    {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int $id
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set authorId
     *
     * @param      int $authorId
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
    }

    /**
     * Get authorId
     *
     * @return     int $authorId
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * Set parentId
     *
     * @param      int $parentId
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    /**
     * Get parentId
     *
     * @return     int $parentId
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set name
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
     * Get name
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
     * Set status
     *
     * @param      string $status
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return     string $status
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set secure
     *
     * @param      boolean $secure
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function setSecure($secure)
    {
        $this->secure = $secure;
    }

    /**
     * Get secure
     *
     * @return     boolean $secure
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function getSecure()
    {
        return $this->secure;
    }

    /**
     * Set credential
     *
     * @param      string $credential
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function setCredential($credential)
    {
        $this->credential = $credential;
    }

    /**
     * Get credential
     *
     * @return     string $credential
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function getCredential()
    {
        return $this->credential;
    }

    /**
     * Set boundTo
     *
     * @param      string $boundTo
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function setBoundTo($boundTo)
    {
        $this->boundTo = $boundTo;
    }

    /**
     * Get boundTo
     *
     * @return     string $boundTo
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function getBoundTo()
    {
        return $this->boundTo;
    }

    /**
     * Set boundToTemplate
     *
     * @param      string $boundToTemplate
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function setBoundToTemplate($boundToTemplate)
    {
        $this->boundToTemplate = $boundToTemplate;
    }

    /**
     * Get boundToTemplate
     *
     * @return     string $boundToTemplate
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function getBoundToTemplate()
    {
        return $this->boundToTemplate;
    }

    /**
     * Set boundToModule
     *
     * @param      string $boundToModule
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function setBoundToModule($boundToModule)
    {
        $this->boundToModule = $boundToModule;
    }

    /**
     * Get boundToModule
     *
     * @return     string $boundToModule
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function getBoundToModule()
    {
        return $this->boundToModule;
    }

    /**
     * Set boundToAction
     *
     * @param      string $boundToAction
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function setBoundToAction($boundToAction)
    {
        $this->boundToAction = $boundToAction;
    }

    /**
     * Get boundToAction
     *
     * @return     string $boundToAction
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function getBoundToAction()
    {
        return $this->boundToAction;
    }

    /**
     * Set createdAt
     *
     * @param      datetime $createdAt
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return     datetime $createdAt
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param      datetime $updatedAt
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updatedAt
     *
     * @return     datetime $updatedAt
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

	/**
     * Add translations
     *
     * @param AgaviPress\PageTranslation $translations
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function addTranslations(\AgaviPress\PageTranslation $translations)
    {
        $this->translations[] = $translations;
    }

    /**
     * Get translations
     *
     * @return Doctrine\Common\Collections\Collection $translations
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * Set author
     *
     * @param AgaviPress\User $author
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function setAuthor(\AgaviPress\User $author)
    {
        $this->author = $author;
    }

    /**
     * Get author
     *
     * @return AgaviPress\User $author
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set parent
     *
     * @param AgaviPress\Page $parent
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function setParent(\AgaviPress\Page $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return AgaviPress\Page $parent
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function getParent()
    {
        return $this->parent;
    }
}