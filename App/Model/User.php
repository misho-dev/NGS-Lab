<?php

namespace App\Model;

class User
{
    /** @var int $id */
    private $id;

    /** @var boolean $isEnabled */
    private $enabled;

    /** @var string $name */
    private $name;

    /** @var string $image */
    private $image;

    /** @var string $gif */
    private $gif;

    /** @var string $shortDescription */
    private $shortDescription;

    /** @var string $description */
    private $description;

    /** @var boolean $isOwner */
    private $isOwner;

    public function __construct($data = [])
    {
        $this->id = $data['entity_id'] ?? '';
        $this->enabled = $data['enabled'] ?? true;
        $this->name = $data['full_name'] ?? '';
        $this->image = $data['image'] ?? '';
        $this->gif = $data['gif'] ?? '';
        $this->shortDescription = $data['short_description'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->isOwner = $data['is_owner'] ?? false;
    }

    /**
     * @return int|mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool|mixed
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return mixed|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getImageAlt()
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getImageTitle()
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getGif()
    {
        return $this->gif;
    }

    /**
     * @param $gif
     */
    public function setGif($gif)
    {
        $this->gif = $gif;
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
     * @return bool|mixed
     */
    public function isProductOwner()
    {
        return $this->isOwner;
    }

    public function getUrl()
    {

    }
}