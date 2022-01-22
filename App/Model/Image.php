<?php

namespace App\Model;

class Image
{
    /** @var int */
    private $id;

    /** @var string */
    private $value;

    /** @var string */
    private $title;

    /** @var string */
    private $alt;

    /** @var string */
    private $type;

    public function __construct($data = [])
    {
        $this->id = $data['entity_id'] ?? '';
        $this->value = $data['value'] ?? '';
        $this->title = $data['title'] ?? '';
        $this->alt = $data['alt'] ?? '';
        $this->type = $data['type'] ?? '';
    }

    /**
     * @return int|mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    public function setAlt($alt)
    {
        $this->alt = $alt;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
}