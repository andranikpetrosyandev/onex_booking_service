<?php

namespace App\Repositories\Core\Room;

class RoomUpdateParams
{
    private int $roomTypeId;

    public function __construct(int $roomTypeId)
    {
        $this->roomTypeId = $roomTypeId;
    }
    public function getRoomTypeId()
    {
        return $this->roomTypeId;
    }
}
