<?php

namespace App\Repositories\Impl;

use App\Models\Booking;
use App\Models\Room;
use App\Repositories\Core\BookingRepository;
use App\Repositories\Core\Booking\BookingCreateParams;
use App\Repositories\Core\Booking\BookingUpdateParams;
use Illuminate\Support\Facades\DB;

class BookingRepositoryImpl implements BookingRepository
{

    public function getPaginate()
    {
        return Booking::with(['user', 'room'])->paginate();
    }

    public function getById(int $bookingid): Booking
    {
        return Booking::findOrFail($bookingid);
    }
    public function getByUserId(int $userId)
    {
        return Booking::where(['user_id' => $userId])->paginate();
    }
    public function create(BookingCreateParams $params): Booking
    {
        return Booking::create([
            'user_id' => $params->getUserId(),
            'room_id' => $params->getRoomId(),
            'checkin_date' => $params->getCheckInDate(),
            'checkout_date' => $params->getCheckOutDate()

        ]);
    }

    public function update(int $id, BookingUpdateParams $params): bool
    {
        return Booking::find($id)->update([
            'user_id' => $params->getUserId(),
            'room_id' => $params->getRoomId(),
            'checkin_date' => $params->getCheckInDate(),
            'checkout_date' => $params->getCheckOutDate()
        ]);
    }
    public function destroy(int $id): int
    {
        return Booking::destroy($id);
    }

    public function searchAvailableRooms(array $params)
    {
        $checkInDate = $params['checkInDate'];
        $checkOutDate = $params['checkOutDate'];
        $rooms = Room::whereNotIn('id', function ($query) use ($params) {
            $query->select('room_id')->from('bookings')
            ->whereBetween('checkin_date', [$params['checkInDate'], $params['checkOutDate']])
            ->whereBetween('checkout_date', [$params['checkInDate'], $params['checkOutDate']]);
        });
        if (isset($params['roomTypeId']) && $params['roomTypeId'] != "null") {
            $rooms = $rooms->where(['room_type_id' => $params['roomTypeId']]);
        }

        return $rooms->get();
    }
}
