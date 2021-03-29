<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Make;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = Car::all();

            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('carModel', function($rst){
                    return empty ($rst->carModel->name) ? $rst->carModel->name : $rst->carModel->name;
                    //return DB::raw("SELECT * FROM 'patients' WHERE 'patients_id' = ?", $action->patient_id);
                })
                ->addColumn('Make', function($action){
                    return empty ($action->Make->name) ? $action->Make->name : $action->Make->name;
                    //return DB::raw("SELECT * FROM 'patients' WHERE 'patients_id' = ?", $action->patient_id);
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="' . route("make.edit", $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn = $btn.'<a href="' . route("make.destroy", $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.car.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.car.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();
            //upload profile pic
            $path = "profiles/default.png";
            if($request->hasFile('image')){
                SaveImageAllSizes($request, 'advertise/');
                $path = 'make/'.$request->image->hashName();
            }
            $data = [
                'name' => $request->name,
                'status' => $request->status,
                'image' => empty($path) ? 'defaul.png' : $path,
            ];
            Make::Create($data);
            DB::commit();
            return redirect(route('car.index'))->with('success', 'Make inserted successfully.');
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = User::find($id);
            if ($data) {
                return view('car.edit',compact('data'));
            } else {
                return Redirect::back()->withErrors(['error', 'Sorry Record not inserted.']);
            }
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted.']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        if(!empty($request->passord)){
            $validated = $request->validate([
                'password_confirmation' => 'required|same:Password',
            ]);
        }
        try {
            //dd($request);
            DB::beginTransaction();
            $user = User::find($id);
            if ($user){
                $data = [
                    'name' => $request->name,
                    'password' => !empty($request->password) ? bcrypt($request->password) : $user->password,
                    'org_password' => !empty($request->password) ? $request->password : $user->password,
                    'phone' => !empty($request->phone) ? $request->phone : $user->phone,
                    'address' => !empty($request->address) ? $request->address : $user->address,
                    'gender' => !empty($request->gendr) ? $request->gendr : $user->gendr,
                ];

                $user->update($data);
                DB::commit();
                return redirect(route('users.index'))->with('success', 'Record has been updated.');
            }
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted.']);
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data_exist = User::find($id);
            if ($data_exist) {
                $data_exist->delete();
                return redirect(route('users.index'))->with('success', 'Record has been deleted.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted.']);
        }
    }
}
