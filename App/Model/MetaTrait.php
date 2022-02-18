<?php

namespace App\Model;

use App\Helper\Session;

trait MetaTrait
{
    /** @var string */
    protected string $metaTitle;

    /** @var string */
    protected string $metaKeyword;

    /** @var string */
    protected string $metaDescription;

    /** @var string */
    protected string $metaTitle_ka;

    /** @var string */
    protected string $metaKeyword_ka;

    /** @var string */
    protected string $metaDescription_ka;

    public function setMetaData($data = [])
    {
        $this->setMetaTitle($data['meta_title'] ?? '');
        $this->setMetaKeyword($data['meta_keyword'] ?? '');
        $this->setMetaDescription($data['meta_description'] ?? '');

        $this->setMetaTitle($data['meta_title_ka'] ?? '', 'ka');
        $this->setMetaKeyword($data['meta_keyword_ka'] ?? '', 'ka');
        $this->setMetaDescription($data['meta_description_ka'] ?? '', 'ka');
    }

    /**
     * @return string
     */
    public function getMetaTitle($lang = '')
    {
        $language = $lang ?: Session::getLanguage();

        if ($language == 'ka')
            return $this->metaTitle_ka;

        return $this->metaTitle;
    }

    /**
     * @return string
     */
    public function getMetaKeyword($lang = '')
    {
        $language = $lang ?: Session::getLanguage();

        if ($language == 'ka')
            return $this->metaKeyword_ka;

        return $this->metaKeyword;
    }

    /**
     * @return string
     */
    public function getMetaDescription($lang = '')
    {
        $language = $lang ?: Session::getLanguage();

        if ($language == 'ka')
            return $this->metaDescription_ka;

        return $this->metaDescription;
    }

    /**
     * @param string $metaTitle
     */
    public function setMetaTitle(string $metaTitle, $lang = 'en'): void
    {
        $language = $lang ?: Session::getLanguage();

        if ($language == 'ka')
            $this->metaTitle_ka = $metaTitle;
        else
            $this->metaTitle = $metaTitle;
    }

    /**
     * @param string $metaKeyword
     */
    public function setMetaKeyword(string $metaKeyword, $lang = 'en'): void
    {
        $language = $lang ?: Session::getLanguage();

        if ($language == 'ka')
            $this->metaKeyword_ka = $metaKeyword;
        else
            $this->metaKeyword = $metaKeyword;
    }

    /**
     * @param string $metaDescription
     */
    public function setMetaDescription(string $metaDescription, $lang = 'en'): void
    {
        $language = $lang ?: Session::getLanguage();

        if ($language == 'ka')
            $this->metaDescription_ka = $metaDescription;
        else
            $this->metaDescription = $metaDescription;
    }
}
