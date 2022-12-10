<?php

namespace App\Repositories\Core\Booking;

class BookingUpdateParams
{
    private int $userId;
    private int $roomId;
    private String $checkInDate;
    private String $checkOutDate;

    public function __construct(int $userId, int $roomId, string $checkInDate, string $checkOutDate)
    {
        $this->userId = $userId;
        $this->roomId = $roomId;
        $this->checkInDate = $checkInDate;
        $this->checkOutDate = $checkOutDate;
    }

    public function getUserId()
    {
        return $this->userId;
    }
    public function getRoomId()
    {
        return $this->roomId;
    }
    public function getCheckInDate()
    {
        return $this->checkInDate;
    }
    public function getCheckOutDate()
    {
        return $this->checkOutDate;
    }
}
