<?php

namespace App\Repositories\Core;

use App\Models\Booking;
use App\Repositories\Core\Booking\BookingCreateParams;
use App\Repositories\Core\Booking\BookingUpdateParams;

interface BookingRepository
{

    function getPaginate(); 
    function getById(int $id):Booking;
    function getByUserId(int $userId);
    function create(BookingCreateParams $params):Booking;
    function update(int $id,BookingUpdateParams $params):bool;
    function destroy(int $id): int;
    function searchAvailableRooms(array $params);
}
