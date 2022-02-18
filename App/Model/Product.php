<?php

namespace App\Model;

use App\Helper\Session;
use App\Model\MetaTrait;

class Product
{
    use MetaTrait;

    /** @var int $id */
    private $id;

    /** @var int $isOwner */
    private $ownerId;

    /** @var string $name */
    private $name;

    /** @var string $name */
    private $name_ka;

    /** @var string $image */
    private $image;

    /** @var string $logo */
    private $logo;

    /** @var string $shortDescription */
    private $shortDescription;

    /** @var string $description */
    private $description;

    /** @var string $shortDescription */
    private $shortDescription_ka;

    /** @var string $description */
    private $description_ka;

    public function __construct($data = [])
    {
        $this->id = $data['entity_id'] ?? null;
        $this->ownerId = $data['owner_id'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->name_ka = $data['name_ka'] ?? '';
        $this->image = $data['image'] ?? '';
        $this->logo = $data['logo'] ?? '';
        $this->shortDescription = $data['short_description'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->shortDescription_ka = $data['short_description_ka'] ?? '';
        $this->description_ka = $data['description_ka'] ?? '';

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
     * @return int|mixed
     */
    public function getOwnerId()
    {
        return $this->ownerId;
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
}