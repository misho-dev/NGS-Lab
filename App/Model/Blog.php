<?php

namespace App\Model;

use App\Helper\Session;
use App\Model\MetaTrait;

class Blog
{
    use MetaTrait;

    /** @var int $id */
    private $id;

    /** @var boolean $enabled */
    private $enabled;

    /** @var string $title */
    private $title;

    /** @var string $description */
    private $description;

    /** @var string $body */
    private $body;

    /** @var string $title */
    private $title_ka;

    /** @var string $description */
    private $description_ka;

    /** @var string $body */
    private $body_ka;

    /** @var int $image */
    private $image;

    /** @var string $createdAt */
    private $createdAt;

    /** @var string $updatedAt */
    private $updatedAt;

    public function __construct($data = [])
    {
        $this->id = $data['entity_id'] ?? '';
        $this->enabled = $data['enabled'] ?? true;
        $this->image = $data['image'] ?? '';
        $this->createdAt = $data['created_at'] ?? '';
        $this->updatedAt = $data['updated_at'] ?? '';

        $this->title = $data['title'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->body = $data['body'] ?? '';

        $this->title_ka = $data['title_ka'] ?? '';
        $this->description_ka = $data['description_ka'] ?? '';
        $this->body_ka = $data['body_ka'] ?? '';

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
     * @return bool|mixed
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return mixed|string
     */
    public function getTitle($lang = '')
    {
        $language = $lang ?: Session::getLanguage();

        if ($language == 'ka')
            return $this->title_ka;

        return $this->title;
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
    public function getBody($lang = '')
    {
        $language = $lang ?: Session::getLanguage();

        if ($language == 'ka')
            return $this->body_ka;

        return $this->body;
    }

    /**
     * @return mixed|int
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed|string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed|string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}