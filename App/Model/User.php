<?php

namespace App\Model;

use App\Model\MetaTrait;

class User
{
    use MetaTrait;

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

    /** @var string $position */
    private $position;

    /** @var string[] $socials */
    private $socials;

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
        $this->position = $data['position'] ?? '';
        $this->isOwner = $data['is_owner'] ?? false;

        $this->setMetaTitle($data['meta_title'] ?? '');
        $this->setMetaKeyword($data['meta_keyword'] ?? '');
        $this->setMetaDescription($data['meta_description'] ?? '');

        if (isset($data['socials'])) {
            $this->socials = $data['socials'] ?? [];
        } else {
            $this->socials = [
                'facebook' => $data['social_facebook'],
                'linkedin' => $data['social_linkedin'],
                'instagram' => $data['social_instagram'],
            ];
        }
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
     * @return mixed|string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return mixed|string
     */
    public function getSocials()
    {
        return $this->socials;
    }

    /**
     * @return bool|mixed
     */
    public function isProductOwner()
    {
        return $this->isOwner;
    }
}