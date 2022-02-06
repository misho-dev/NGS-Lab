<?php

namespace App\Model;

use App\Model\MetaTrait;

class Project
{
    use MetaTrait;

    /** @var int $id */
    private $id;

    /** @var string $name */
    private $name;

    /** @var string $image */
    private $image;

    /** @var string $logo */
    private $logo;

    /** @var string $shortDescription */
    private $shortDescription;

    /** @var string $description */
    private $description;

    /** @var string $sliderHtml */
    private $sliderHtml;

    public function __construct($data = [])
    {
        $this->id = $data['entity_id'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->shortDescription = $data['short_description'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->sliderHtml = $data['slider_html'] ?? '';
        $this->image = $data['image'] ?? '';
        $this->logo = $data['logo'] ?? '';

        $this->setMetaTitle($data['meta_title'] ?? '');
        $this->setMetaKeyword($data['meta_keyword'] ?? '');
        $this->setMetaDescription($data['meta_description'] ?? '');
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
    public function getName()
    {
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
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * @return mixed|string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed|string
     */
    public function getSliderHtml()
    {
        return $this->sliderHtml;
    }
}
