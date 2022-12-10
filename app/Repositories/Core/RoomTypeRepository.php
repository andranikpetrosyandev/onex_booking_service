<?php

namespace App\Repositories\Core;

use App\Models\RoomType;
use App\Repositories\Core\RoomType\RoomTypeCreateParams;
use App\Repositories\Core\RoomType\RoomTypeUpdateParams;
use Illuminate\Validation\Rules\In;

interface RoomTypeRepository
{
    public function getAll();
    public function getByPage();
    public function getById($id): RoomType;
    public function create(RoomTypeCreateParams $roomTypeCreateParams): RoomType;
    public function update(int $id, RoomTypeUpdateParams $roomTypeUpdateParams): bool;
    public function destroy(int $id): int;
}
