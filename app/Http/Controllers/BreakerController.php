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
use Illuminate\Support\Facades\Session;

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
    public function orderSave(Request $request)
    {
        //dd($request);

        try {
            $user = \Auth::user();
            DB::beginTransaction();

            foreach ($request->product_id as $p_id) {

                $product_exist = SparePart::find($p_id);
                if ($product_exist) {
                    $data = [
                        'user_id' => $user->id,
                        'spare_part_id' => $p_id,
                        'price' => $product_exist->price * $request->$p_id,
                        'quantity' => $request->$p_id,
                    ];
                    Sale::Create($data);
                }
            }
            Session::forget('cart');
            $data = [];
            \Mail::send('email.message', $data, function($message) use ($data) {
                $message->to('jk@gmail.com', '')->subject
                ("Testing email by Spareparts");
                $message->from('admin@admin.com','Spareparts');
            });
            DB::commit();
           // return Redirect::back()->with('success', 'Order Submitted successfully.');

             return redirect(route('home'))->with('success', 'Order sumitted successfully.');
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted.']);
        }
    }
}
