<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomCreateRequest;
use App\Http\Requests\Room\RoomUpdateRequest;
use App\Repositories\Core\Room\RoomCreateParams;
use App\Repositories\Core\Room\RoomUpdateParams;
use App\Repositories\Core\RoomRepository;
use App\Repositories\Core\RoomTypeRepository;

class RoomController extends Controller
{
    private RoomRepository $roomRepository;
    private RoomTypeRepository $roomTypeRepository;

    public function __construct(RoomRepository $roomRepository, RoomTypeRepository $roomTypeRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->roomTypeRepository = $roomTypeRepository;
    }

    public function index()
    {
        $rooms = $this->roomRepository->getPaginate();
        return view('admin.rooms.index', ['rooms' => $rooms]);
    }
    public function create()
    {
        $roomTypes = $this->roomTypeRepository->getAll();

        return view('admin.rooms.create', ['roomTypes' => $roomTypes]);
    }
    public function store(RoomCreateRequest $request)
    {
        $this->roomRepository->create(new RoomCreateParams(
            $request->input('room_type_id')
        ));
        return redirect()->route('admin.rooms.index');
    }
    public function edit(int $id)
    {
        $room = $this->roomRepository->getById($id);
        $roomTypes = $this->roomTypeRepository->getAll();
        return view('admin.rooms.edit', [
            'roomTypes' => $roomTypes,
            'room'=>$room
        ]);
    }
    public function update(int $id, RoomUpdateRequest $request )
    {
        $this->roomRepository->update($id,new RoomUpdateParams(
            $request->input('room_type_id')
        ));

        return redirect()->route('admin.rooms.index');
    }

    public function destroy(int $id)
    {
        $this->roomRepository->destroy($id);
        return redirect()->route('admin.rooms.index');
    }

    public function search(){
        
        return response()->json();
    }
}
