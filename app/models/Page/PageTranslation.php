<?php

namespace AgaviPress;

/**
 * AgaviPress\PageTranslation
 */
class PageTranslation
{
    /**
     * @var string $slug
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $slug;

    /**
     * @var string $slugParameters
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $slugParameters;

    /**
     * @var string $title
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $title;

    /**
     * @var text $content
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $content;

    /**
     * @var integer $id
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $id;

    /**
     * @var string $language
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $language;

    /**
     * @var AgaviPress\Page
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    private $page;

    /**
     * Set slug
     *
     * @param string $slug
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string $slug
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set parameter
     *
     * @param string $parameter
	 *
	 * @since      0.1.0
	 * @author     Jean-Philippe Dery <jeanphilippe.dery@gmail.com>
     */
    public function setSlugParameters($slugParameters)
    {
        $this->slugParameters = $slugParameters;
    }

    /**
     * Get parameter
     *
     * @return string $slugParameter
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return text $content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set id
     *
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set language
     *
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * Get language
     *
     * @return string $language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set page
     *
     * @param AgaviPress\Page $page
     */
    public function setPage(\AgaviPress\Page $page)
    {
        $this->page = $page;
    }

    /**
     * Get page
     *
     * @return AgaviPress\Page $page
     */
    public function getPage()
    {
        return $this->page;
    }
}