<?php
namespace StaticPage\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StaticPage
 *
 * @ORM\Table(name="static_page", uniqueConstraints={@ORM\UniqueConstraint(name="idx_static_page", columns={"slug"})})
 * @ORM\Entity
 */
class StaticPage
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->locale = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false)
     */
    private $slug;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_time", type="datetime", nullable=false)
     */
    private $createdTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified_time", type="datetime", nullable=true)
     */
    private $modifiedTime;

    /**
     * @ORM\OneToMany(targetEntity="StaticPageLocale", mappedBy="staticPage", cascade={"persist", "remove"})
     **/
    private $locale;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_published", type="boolean", nullable=false)
     */
    private $isPublished = false;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return StaticPage
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set createdTime
     *
     * @param \DateTime $createdTime
     * @return StaticPage
     */
    public function setCreatedTime($createdTime)
    {
        $this->createdTime = $createdTime;

        return $this;
    }

    /**
     * Get createdTime
     *
     * @return \DateTime
     */
    public function getCreatedTime()
    {
        return $this->createdTime;
    }

    /**
     * Set modifiedTime
     *
     * @param \DateTime $modifiedTime
     * @return StaticPage
     */
    public function setModifiedTime($modifiedTime)
    {
        $this->modifiedTime = $modifiedTime;

        return $this;
    }

    /**
     * Get modifiedTime
     *
     * @return \DateTime
     */
    public function getModifiedTime()
    {
        return $this->modifiedTime;
    }

    /**
     * Add locale
     *
     * @param \StaticPage\Entity\StaticPageLocale $locale
     * @return StaticPage
     */
    public function addLocale(\StaticPage\Entity\StaticPageLocale $locale)
    {
        $this->locale[] = $locale;

        return $this;
    }

    /**
     * Remove locale
     *
     * @param \StaticPage\Entity\StaticPageLocale $locale
     */
    public function removeLocale(\StaticPage\Entity\StaticPageLocale $locale)
    {
        $this->locale->removeElement($locale);
    }

    /**
     * Get locale
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set isPublished
     *
     * @param boolean $isPublished
     * @return StaticPage
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Get isPublished
     *
     * @return boolean 
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }
}
