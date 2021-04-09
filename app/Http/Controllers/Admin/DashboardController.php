<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Make;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {

        $this->middleware('auth');
    }*/
    /**
     * Show the application dashboard.
     * eSquall@318
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){

        return view('admin.dashboard');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function supplier(Request $request)
    {
        if ($request->ajax()) {
            $data = User::whereUserType('Supplier')->with('supplier')->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->addColumn('trade_name', function($rst){
                    return !empty ($rst->supplier->trade_name) ? $rst->supplier->trade_name : "";
                })

                ->addColumn('business_type', function($rst){
                    return !empty ($rst->supplier->business_type) ? $rst->supplier->business_type : "";
                })
                ->addColumn('vehicle_parts_deal', function($rst){
                    return !empty ($rst->supplier->vehicle_parts_deal) ? $rst->supplier->vehicle_parts_deal : "";
                })

                ->addColumn('action', function($row){
                    $btn = '<a href="' . route("admin.supplier.destroy", $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.suppier.list');
    }
}
