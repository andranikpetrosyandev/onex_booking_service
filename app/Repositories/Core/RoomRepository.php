<?php

namespace App\Repositories\Core;
use App\Repositories\Core\Room\RoomCreateParams;
use App\Repositories\Core\Room\RoomUpdateParams;
use App\Models\Room;

interface RoomRepository{

    function getAll();
    function getPaginate();
    function getById(int $id):Room;
    function getByTypeId(int $typeId);
    function create(RoomCreateParams $params):Room;
    function update(int $id,RoomUpdateParams $params):bool;
    function destroy(int $id): int;
    function checkRoomAvailability(int $id, string $checkinDate, string $checkoutDate):bool;
    
}