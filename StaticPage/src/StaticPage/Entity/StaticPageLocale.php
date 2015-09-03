<?php

namespace StaticPage\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StaticPageLocale
 *
 * @ORM\Table(name="static_page_locale", uniqueConstraints={@ORM\UniqueConstraint(name="idx_static_page_locale", columns={"static_page_id", "language_id"})}, indexes={@ORM\Index(name="idx_static_page_locale_1", columns={"static_page_id"}), @ORM\Index(name="idx_static_page_locale_0", columns={"language_id"})})
 * @ORM\Entity
 */
class StaticPageLocale
{
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
     * @ORM\Column(name="language_id", type="string", length=5, nullable=false)
     */
    private $languageId;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="html_title", type="string", length=255, nullable=false)
     */
    private $metaTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="html_keywords", type="string", length=255, nullable=true)
     */
    private $metaKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="text", nullable=true)
     */
    private $metaDescription;

    /**
     * @var StaticPage
     *
     * @ORM\ManyToOne(targetEntity="StaticPage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="static_page_id", referencedColumnName="id")
     * })
     */
    private $staticPage;



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
     * Set languageId
     *
     * @param string $languageId
     * @return StaticPageLocale
     */
    public function setLanguageId($languageId)
    {
        $this->languageId = $languageId;

        return $this;
    }

    /**
     * Get languageId
     *
     * @return string
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return StaticPageLocale
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set staticPage
     *
     * @param \StaticPage\Entity\StaticPage $staticPage
     * @return StaticPageLocale
     */
    public function setStaticPage(\StaticPage\Entity\StaticPage $staticPage = null)
    {
        $this->staticPage = $staticPage;

        return $this;
    }

    /**
     * Get staticPage
     *
     * @return \StaticPage\Entity\StaticPage
     */
    public function getStaticPage()
    {
        return $this->staticPage;
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     * @return StaticPageLocale
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * Get metaTitle
     *
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * Set metaKeywords
     *
     * @param string $metaKeywords
     * @return StaticPageLocale
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * Get metaKeywords
     *
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     * @return StaticPageLocale
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaKeywords
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }
}
