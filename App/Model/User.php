<?php

namespace App\Model;

use App\Helper\Session;
use App\Model\MetaTrait;

class User
{
    use MetaTrait;

    /** @var int */
    private $id;

    /** @var boolean */
    private $enabled;

    /** @var string */
    private $name;

    /** @var string */
    private $name_ka;

    /** @var int */
    private $image;

    /** @var int */
    private $gif;

    /** @var string */
    private $shortDescription;

    /** @var string */
    private $description;

    /** @var string */
    private $position;

    /** @var string */
    private $shortDescription_ka;

    /** @var string */
    private $description_ka;

    /** @var string */
    private $position_ka;

    /** @var string[] $socials */
    private $socials;

    /** @var boolean $isOwner */
    private $isOwner;

    public function __construct($data = [])
    {
        $this->id = $data['entity_id'] ?? '';
        $this->enabled = $data['enabled'] ?? true;
        $this->name = $data['full_name'] ?? '';
        $this->name_ka = $data['full_name_ka'] ?? '';
        $this->image = $data['image'] ?? '';
        $this->gif = $data['gif'] ?? '';
        $this->shortDescription = $data['short_description'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->position = $data['position'] ?? '';
        $this->shortDescription_ka = $data['short_description_ka'] ?? '';
        $this->description_ka = $data['description_ka'] ?? '';
        $this->position_ka = $data['position_ka'] ?? '';
        $this->isOwner = $data['is_owner'] ?? false;

        $this->setMetaData($data);

        if (isset($data['socials'])) {
            $this->socials = $data['socials'] ?? [];
        } else {
            $this->socials = [
                'facebook' => $data['social_facebook'] ?? '',
                'linkedin' => $data['social_linkedin'] ?? '',
                'instagram' => $data['social_instagram'] ?? '',
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
    public function getName($lang = '')
    {
        $language = $lang ?: Session::getLanguage();

        if ($language == 'ka')
            return $this->name_ka;

        return $this->name;
    }

    /**
     * @return int
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
    public function getPosition($lang = '')
    {
        $language = $lang ?: Session::getLanguage();

        if ($language == 'ka')
            return $this->position_ka;

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