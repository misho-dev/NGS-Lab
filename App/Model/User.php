<?php

namespace App\Model;

class User
{
    /** @var int $id */
    private $id;

    /** @var string $name */
    private $name;

    /** @var string $image */
    private $image;

    /** @var string $shortDescription */
    private $shortDescription;

    /** @var string $description */
    private $description;

    /** @var boolean $isOwner */
    private $isOwner;

    public function __construct($data)
    {
        $this->id = $data['entity_id'] ?? '';
        $this->name = $data['full_name'] ?? '';
        $this->image = $data['image'] ?? '';
        $this->shortDescription = $data['short_description'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->isOwner = $data['is_owner'] ?? '';
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
}