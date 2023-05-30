<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    private $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = $this->order->query();
            return DataTables::of($data)->make(true);
        }

        return view('main.orders');
    }
}
