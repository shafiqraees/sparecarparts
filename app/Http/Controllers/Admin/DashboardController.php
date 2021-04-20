<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Make;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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
            $data = User::whereUserType('Supplier')->with('supplier')->orderBy('created_at', 'desc')->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->addColumn('trade_name', function($rst){
                    return !empty ($rst->supplier->trade_name) ? $rst->supplier->trade_name : "";
                })
                ->editColumn('created_at', function ($record) {
                    return $record->created_at->diffForHumans();
                })

                ->addColumn('business_type', function($rst){
                    return !empty ($rst->supplier->business_type) ? $rst->supplier->business_type : "";
                })
                ->addColumn('account_status', function($rst){
                    return !empty ($rst->supplier->account_status) ? $rst->supplier->account_status : "";
                })

                ->addColumn('action', function($row){

                    $btn = '<a href="' . route("admin.supplier.show", $row->id) . '" class="edit btn btn-primary btn-sm">View</a>';
                    $btn = $btn.'<a href="' . route("admin.supplier.destroy", $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.suppier.list');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function supplierDetial($id)
    {
        try {
            $data = User::whereId($id)->whereHas('supplier')->with('supplier')->first();

            if ($data) {
                return view('admin.suppier.detail',compact('data'));
            } else {
                return Redirect::back()->withErrors(['Sorry Record not found.']);
            }
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['Sorry Record not found.']);
        }

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function supplierEdit(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required',
        ]);

        try {
        //dd($request);
        $make = Supplier::find($id);
        DB::beginTransaction();
        if ($make){
            $data = [
                'account_status' => !empty($request->status) ? $request->status : $make->account_status,
            ];
            $make->update($data);
            DB::commit();
            return Redirect::back()->with('success', 'Status has been updated successfully.');
        }
        return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted.']);
        }
    }
}
