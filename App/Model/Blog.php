<?php

namespace App\Model;

class Blog
{
    /** @var int $id */
    private $id;

    /** @var boolean $isEnabled */
    private $enabled;

    /** @var string $title */
    private $title;

    /** @var string $title */
    private $body;

    /** @var string $isOwner */
    private $metaKeys;

    /** @var string $isOwner */
    private $createdAt;

    /** @var string $isOwner */
    private $updatedAt;

    public function __construct($data)
    {
        $this->id = $data['entity_id'] ?? '';
        $this->enabled = $data['enabled'] ?? true;
        $this->title = $data['title'] ?? '';
        $this->body = $data['body'] ?? '';
        $this->metaKeys = $data['meta_keys'] ?? '';
        $this->createdAt = $data['created_at'] ?? '';
        $this->updatedAt = $data['updated_at'] ?? '';
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
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return bool|mixed
     */
    public function getMetaKeys()
    {
        return $this->metaKeys;
    }

    /**
     * @return bool|mixed
     */
    public function getMetaKeysAsArray()
    {
        return explode(',', $this->metaKeys);
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