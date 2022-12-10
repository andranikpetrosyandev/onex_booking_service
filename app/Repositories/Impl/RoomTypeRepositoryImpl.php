<?php

namespace App\Repositories\Impl;

use App\Models\RoomType;
use App\Repositories\Core\RoomType\RoomTypeCreateParams;
use App\Repositories\Core\RoomType\RoomTypeUpdateParams;
use App\Repositories\Core\RoomTypeRepository;

class RoomTypeRepositoryImpl implements RoomTypeRepository
{
    public function getAll()
    {
        return RoomType::all();
    }
    public function getByPage()
    {
        return RoomType::paginate(2);
    }
    public function getById($id):RoomType
    {
        return RoomType::findOrFail($id);
    }
    public function create(RoomTypeCreateParams $roomTypeCreateParams):RoomType
    {
        return RoomType::create([
            'name'          =>$roomTypeCreateParams->getName(),
            'description'   => $roomTypeCreateParams->getDescription()
        ]);
    }
    public function update(int $id, RoomTypeUpdateParams $roomTypeUpdateParams): bool
    {
        return RoomType::find($id)->update([
            'name'          =>$roomTypeUpdateParams->getName(),
            'description'   => $roomTypeUpdateParams->getDescription()
        ]);
    }
    public function destroy(int $id):int
    {
        return RoomType::destroy($id);

    }
}
