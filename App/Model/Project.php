<?php

namespace App\Model;

use App\Helper\Session;
use App\Model\MetaTrait;

class Project
{
    use MetaTrait;

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $name_ka;

    /** @var string */
    private $image;

    /** @var string */
    private $logo;

    /** @var string */
    private $shortDescription;

    /** @var string */
    private $description;

    /** @var string */
    private $sliderHtml;

    /** @var string */
    private $shortDescription_ka;

    /** @var string */
    private $description_ka;

    /** @var string */
    private $sliderHtml_ka;

    public function __construct($data = [])
    {
        $this->id = $data['entity_id'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->shortDescription = $data['short_description'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->sliderHtml = $data['slider_html'] ?? '';
        $this->name_ka = $data['name_ka'] ?? '';
        $this->shortDescription_ka = $data['short_description_ka'] ?? '';
        $this->description_ka = $data['description_ka'] ?? '';
        $this->sliderHtml_ka = $data['slider_html_ka'] ?? '';
        $this->image = $data['image'] ?? '';
        $this->logo = $data['logo'] ?? '';

        $this->setMetaData($data);
    }

    /**
     * @return int|mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed|string
     */
    public function getName($lang = '')
    {
        $language = $lang ?: Session::getLanguage();

        if ($language == 'ka')
            return $this->name_ka;

        return $this->name;
    }

    /**
     * @return mixed|string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed|string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @return mixed|string
     */
    public function getShortDescription($lang = '')
    {
        $language = $lang ?: Session::getLanguage();

        if ($language == 'ka')
            return $this->shortDescription_ka;

        return $this->shortDescription;
    }

    /**
     * @return mixed|string
     */
    public function getDescription($lang = '')
    {
        $language = $lang ?: Session::getLanguage();

        if ($language == 'ka')
            return $this->description_ka;

        return $this->description;
    }

    /**
     * @return mixed|string
     */
    public function getSliderHtml($lang = '')
    {
        $language = $lang ?: Session::getLanguage();

        if ($language == 'ka')
            return $this->sliderHtml_ka;

        return $this->sliderHtml;
    }
}
