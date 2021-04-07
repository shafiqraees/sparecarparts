<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function join()
    {
        return view('supplier.join');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "trade_name" => "required",
            "contact_name" => "nullable",
            "contact_tel" => "nullable",
            "email" => "required|email|unique:users",
            "address_1" => "nullable",
            "address_2" => "nullable",
            "post_town" => "nullable",
            "county" => "nullable",
            "country" => "nullable",
            "postcode" => "nullable",
            "website_address" => "nullable",
            "business_type" => "nullable",
            "company_registration_number" => "required",
            "vat_registered" => "required",
            "trading_years" => "nullable",
            "about" => "nullable",
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors(['error' => 'Required fields are empty']);
        }
        try {
            $user = User::create([
                'name' => $request->contact_name,
                'email' => $request->email,
                'phone' => $request->contact_tel,
                'password' => empty($request->password) ? '' : bcrypt($request->password),
                'user_type' => 'Supplier',
            ]);
            Supplier::create([
                'user_id' => $user->id,
                "trade_name" => $request->trade_name,
                "contact_name" => $request->contact_name,
                "contact_tel" => $request->contact_tel,
                "contact_email" => $request->email,
                "address_1" => $request->address_1,
                "address_2" => $request->address_2,
                "post_town" => $request->post_town,
                "county" => $request->county,
                "country" => $request->country,
                "postcode" => $request->postcode,
                "website_address" => $request->website_address,
                "business_type" => $request->business_type,
                "company_registration_number" => $request->company_registration_number,
                "vat_registered" => $request->vat_registered,
                "trading_years" => $request->trading_years,
                "vehicle_parts_deal" => $request->vehicle_parts_deal,
                "ebay_account_username" => $request->ebay_account_username,
                "about" => $request->about,
            ]);

            DB::commit();
            return Redirect::back()->withSuccess(['success', 'Registered successfully']);

        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted']);
        }
    }
}