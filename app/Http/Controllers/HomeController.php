<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\RoomTypeController;
use App\Repositories\Core\RoomRepository;
use App\Repositories\Core\RoomTypeRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private RoomTypeRepository $roomTypeRepository ;
    private RoomRepository $roomRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RoomTypeRepository $roomTypeRepository,RoomRepository $roomRepository)
    {
        $this->roomTypeRepository = $roomTypeRepository;
        $this->roomRepository = $roomRepository;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $roomTypes = $this->roomTypeRepository->getAll();
        $rooms = $this->roomRepository->getPaginate();
        return view('home',[
            'roomTypes'=>$roomTypes,
            'rooms' => $rooms
        ]);
    }
}
