<?php

namespace App\Model;

use App\Helper\Encrypter;

class Administrator
{
    /** @var int $id */
    private $id;

    /** @var string $username */
    private $username;

    /** @var string $password */
    private $password;

    /** @var string $permissions */
    private $permissions;

    public function __construct($data = [])
    {
        $this->id = $data['entity_id'] ?? '';
        $this->username = $data['username'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->permissions = $data['permissions'] ?? '';
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed|string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @param bool $encrypted
     */
    public function setPassword(string $password, $encrypted = false)
    {
        if ($encrypted) {
            $this->password = $password;
        } else {
            $this->password = Encrypter::encrypt($password);
        }
    }

    /**
     * @return mixed|string
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @return false|string[]
     */
    public function getPermissionsAsArray()
    {
        return explode(',', $this->permissions);
    }

    /**
     * @param string[]|string $permissions
     */
    public function setPermissions($permissions)
    {
        if (is_array($permissions)) {
            $this->permissions = implode(',', $permissions);
        } else if (is_string($permissions)) {
            $this->permissions = $permissions;
        }
    }
}