<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomType\RoomTypeCreateRequest;
use App\Http\Requests\RoomType\RoomTypeUpdateRequest;
use App\Repositories\Core\RoomType\RoomTypeCreateParams;
use App\Repositories\Core\RoomType\RoomTypeUpdateParams;
use App\Repositories\Core\RoomTypeRepository;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{

    private RoomTypeRepository $roomTypeRepository;

    public function __construct(RoomTypeRepository $roomTypeRepository)
    {
        $this->roomTypeRepository = $roomTypeRepository;
    }

    public function index()
    {
        $roomTypes = $this->roomTypeRepository->getByPage();
        return view('admin.roomType.index', ['room_types' => $roomTypes]);
    }
    public function show($id)
    {
    }
    public function create()
    {
        return view("admin.roomType.create");
    }

    public function store(RoomTypeCreateRequest $request)
    {

        $this->roomTypeRepository->create(new RoomTypeCreateParams(
            $request->input('name'),
            $request->input('description')
        ));
        return redirect()->route('admin.roomtype.index');
    }
    public function edit(int $id)
    {
        $roomType = $this->roomTypeRepository->getById($id);
        return view('admin.roomType.edit', ['room_type' => $roomType]);
    }
    public function update(int $id, RoomTypeUpdateRequest $request)
    {
        $status = $this->roomTypeRepository->update($id, new RoomTypeUpdateParams(
            $request->input('name'),
            $request->input('description'),
        ));
        if ($status) {
            return redirect()->route('admin.roomtype.edit', $id);
        }
    }
    public function destroy(Request $request, $id)
    {
        $this->roomTypeRepository->destroy($id);
        return redirect()->route('admin.roomtype.index');
    }
}
