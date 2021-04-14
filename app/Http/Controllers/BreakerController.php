<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Make;
use App\Models\Sale;
use App\Models\SparePart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BreakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //try {
            $user = \Auth::user();
            return view('frontend.customer.detail',compact('user'));

        /*} catch ( \Exception $e) {
            return Redirect::back()->withErrors(['error', 'Sorry something went wrong']);
        }*/

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $cars = Car::whereStatus('publish')->get();
            return view('admin.spare_parts.create',compact('cars'));

        } catch ( \Exception $e) {
            return Redirect::back()->withErrors(['error', 'Sorry something went wrong']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderSave(Request $request,$id)
    {
        //try {
            $user = \Auth::user();
            $spare = SparePart::find($id);
            DB::beginTransaction();
            $data = [
                'user_id' => $user->id,
                'spare_part_id' => $id,
                'price' => $spare->price,
            ];
            Sale::Create($data);
        /*$data = [];
        \Mail::send('email.message', $data, function($message) use ($data) {
            $message->to('jk@gmail.com', '')->subject
            ("Testing email by Spareparts");
            $message->from('admin@admin.com','Spareparts');
        });*/
            DB::commit();
            return Redirect::back()->with('success', 'Order Submitted successfully.');
/*            return redirect(route('make.index'))->with('success', 'Make inserted successfully.');*/
        /*} catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted.']);
        }*/
    }
}
