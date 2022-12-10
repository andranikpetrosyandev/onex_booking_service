<?php

namespace App\Repositories\Core\RoomType;

class RoomTypeUpdateParams{
    private String $name;
    private String $description;

    public function __construct(string $name, string $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }
}