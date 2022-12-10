<?php

namespace App\Repositories\Core\Booking;

use Illuminate\Support\Facades\Date;
use Ramsey\Uuid\Type\Integer;

class AvailableRoomSearchParams
{

    private int $roomTypeId;
    private string $checkInDate;
    private string $checkOutDate;

    public function __construct(int $roomTypeId, string $checkInDate, string $checkOutDate)
    {
        $this->roomTypeId = $roomTypeId;
        $this->checkInDate  = $checkInDate;
        $this->checkOutDate = $checkOutDate;
    }
    public function getRoomTypeId()
    {
        if($this->roomTypeId != 0){
            return $this->roomTypeId;
        }else{
            return null;
        }
    }
    public function getCheckInDate()
    {
        return $this->checkInDate;
    }
    public function getCHeckOutDate()
    {
        return $this->checkOutDate;
    }
}
