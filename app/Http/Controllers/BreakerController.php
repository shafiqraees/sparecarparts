<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\SparePart;
use App\Models\User;
use Illuminate\Http\Request;
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
}
