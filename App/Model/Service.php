<?php

namespace App\Model;

use App\Helper\Session;

class Service
{
    /** @var int */
    private $id;

    /** @var string $name */
    private $title;

    /** @var string */
    private $title_ka;

    /** @var string */
    private $image;


    public function __construct($data = [])
    {
        $this->id = $data['entity_id'] ?? null;
        $this->title = $data['title'] ?? '';
        $this->title_ka = $data['title_ka'] ?? '';
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
    public function getImage()
    {
        return $this->image;
    }
}
