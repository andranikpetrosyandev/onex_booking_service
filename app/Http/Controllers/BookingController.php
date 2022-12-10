<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\BookingCreateRequest;
use App\Http\Requests\Booking\BookingUpdateRequest;
use App\Http\Requests\Booking\BookingViewAllRequest;
use App\Repositories\Core\Booking\BookingCreateParams;
use App\Repositories\Core\BookingRepository;
use App\Repositories\Core\RoomRepository;
use App\Repositories\Core\RoomTypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Repositories\Core\Booking\BookingUpdateParams;

class BookingController extends Controller
{

    private RoomRepository $roomRepository;
    private RoomTypeRepository $roomTypeRepository;
    private BookingRepository $bookingRepository;

    public function __construct(RoomRepository $roomRepository, BookingRepository $bookingRepository, RoomTypeRepository $roomTypeRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->bookingRepository = $bookingRepository;
        $this->roomTypeRepository = $roomTypeRepository;
    }
    public function index(BookingViewAllRequest $request)
    {
        $bookings = $this->bookingRepository->getPaginate();
        return view('booking.index', [
            'bookings' => $bookings
        ]);
    }
    public function own(Request $request)
    {

        $bookings = $this->bookingRepository->getByUserId(Auth::user()->id);
        return view('booking.index', [
            'bookings' => $bookings
        ]);
    }
    public function create(int $roomId)
    {
        $roomTypes = $this->roomTypeRepository->getAll();
        $room = $this->roomRepository->getById($roomId);
        return view('booking.create', [
            'room' => $room,
            'roomTypes' => $roomTypes,
        ]);
    }
    public function edit(int $bookingId)
    {
        $booking = $this->bookingRepository->getById($bookingId);
        $rooms = $this->roomRepository->getAll();

        return view('booking.edit', [
            'rooms' => $rooms,
            'booking' => $booking,
        ]);
    }
    public function update(int $bookingId, BookingUpdateRequest $request)
    {
        $booking = $this->bookingRepository->update($bookingId, new BookingUpdateParams(
            $request->input('user_id'),
            $request->input('room_id'),
            $request->input('checkin_date'),
            $request->input('checkout_date')
        ));
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.booking.index');
        }
        return redirect()->route('booking.own');
    }

    public function store(BookingCreateRequest $request)
    {
        if ($this->roomRepository->checkRoomAvailability($request->input('room_id'), $request->input('checkin_date'), $request->input('checkout_date'))) {
            return back()->with('error', 'Room Already reserved for this date');
        }
        $this->bookingRepository->create(new BookingCreateParams(
            $request->input('user_id'),
            $request->input('room_id'),
            $request->input('checkin_date'),
            $request->input('checkout_date')
        ));
        return redirect()->route('booking.own');
    }
    public function destroy(Request $request, $id)
    {
        $this->bookingRepository->destroy($id);
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.booking.index');
        }
        return redirect()->route('booking.own');
    }

    public function availableRooms(Request $request): JsonResponse
    {

        $response =  $this->bookingRepository->searchAvailableRooms(
            $request->all()
        );
        return response()->json(['data' => $response]);
    }
}
