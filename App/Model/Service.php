<?php

namespace App\Model;

class Service
{
    /** @var int $id */
    private $id;

    /** @var string $name */
    private $title;

    /** @var string $image */
    private $image;


    public function __construct($data = [])
    {
        $this->id = $data['entity_id'] ?? null;
        $this->title = $data['title'] ?? '';
        $this->image = $data['image'] ?? '';
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed|string
     */
    public function getImage()
    {
        return $this->image;
    }
}
