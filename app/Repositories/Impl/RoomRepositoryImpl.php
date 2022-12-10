<?php

namespace App\Repositories\Impl;

use App\Models\Booking;
use App\Repositories\Core\RoomRepository;
use App\Repositories\Core\Room\RoomCreateParams;
use App\Repositories\Core\Room\RoomUpdateParams;
use App\Models\Room;

class RoomRepositoryImpl implements RoomRepository
{
    public function getAll()
    {
        return Room::all();
    }
    public function getPaginate()
    {
        return Room::paginate(15);
    }
    public function getById(int $id): Room
    {
        return Room::findOrFail($id);
    }
    public function getByTypeId(int $typeId)
    {
        return Room::where(['room_type_id' => $typeId])->paginate();
    }
    public function create(RoomCreateParams $params): Room
    {
        return Room::create([
            'room_type_id' => $params->getRoomTypeId(),
        ]);
    }
    public function update(int $id, RoomUpdateParams $params): bool
    {
        return Room::find($id)->update([
            'room_type_id' => $params->getRoomTypeId()
        ]);
    }
    public function destroy(int $id): int
    {
        return Room::destroy($id);
    }
    public function checkRoomAvailability(int $id, string $checkinDate, string $checkoutDate): bool
    {

        // $rooms = Room::whereNotIn('id', function ($query) use ($checkinDate,$checkoutDate) {
        //     $query->select('room_id')->from('bookings')
        //     ->whereBetween('checkin_date', [$checkinDate, $checkoutDate])
        //     ->whereBetween('checkout_date', [$checkinDate, $checkoutDate]);
        // });

        return(Booking::where(['room_id' => $id])->where(function ($query) use ($checkinDate, $checkoutDate) {
            $query->orWhere(function ($query)  use ($checkinDate, $checkoutDate) {
                $query->where('checkin_date', '>', $checkinDate)->where('checkout_date', '<', $checkoutDate);
            })->orWhere(function ($query)  use ($checkinDate, $checkoutDate) {
                $query->where('checkin_date', '<', $checkinDate)->where('checkout_date', '>', $checkoutDate);
            })->orWhere(function ($query)  use ($checkinDate, $checkoutDate) {
                $query->whereBetween('checkin_date', [$checkinDate, $checkoutDate]);
            })->orWhere(function ($query)  use ($checkinDate, $checkoutDate) {
                $query->whereBetween('checkout_date',  [$checkinDate, $checkoutDate]);
            });
        })->exists());

        
        // ->whereBetween('checkin_date', [$checkinDate, $checkoutDate])
        // ->whereBetween('checkout_date',  [$checkoutDate, $checkoutDate])->exists();
    }
}
