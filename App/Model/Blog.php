<?php

namespace App\Model;

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
        $this->title = $data['title'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->body = $data['body'] ?? '';
        $this->image = $data['image'] ?? '';
        $this->createdAt = $data['created_at'] ?? '';
        $this->updatedAt = $data['updated_at'] ?? '';

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
     * @return bool|mixed
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return mixed|string
     */
    public function getTitle()
    {
        return $this->title;
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
    public function getBody()
    {
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