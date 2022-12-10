<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use App\Repositories\Core\RoomRepository;
use App\Repositories\Core\RoomTypeRepository;

class DashboardController extends Controller
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
        $roomTypes = RoomType::withCount('rooms')->get();
        return view('admin.dashboard.index',['room_types'=>$roomTypes]);
    }
}
