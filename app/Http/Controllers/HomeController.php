<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Make;
use App\Models\SparePart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    protected $url;
    protected $path;
    protected $key;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->url = config('app.DVLA_API_URL');
        $this->key = config('app.DVLA_API_KEY');

        $this->url .= $this->path;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $make = Make::whereStatus('publish')->withoutTrashed()->get();

            return view('frontend.index',compact('make'));
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        }
    }



    /**
     * Show the car spareparts.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCarSpareParts()
    {
        try {
//            dd(\request('registration_number'));
            $cars = Car::search(\request('registration_number'))->with(['spareParts'])->first();
            $spare_parts = $cars->spareParts;

            return view('frontend.sparepart.spare_parts', compact('spare_parts'));
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function vehicleDetail()
    {
        $queryArray = ['registrationNumber' => 'WN67DSO'];
        $api_data = $this->makeRequest( $queryArray );
        $data = json_decode($api_data, true);
        return view('frontend.vehicle.detail',compact('data'));
    }

    /**
     * Show the application dashboard.
     *
     * @Requesst \Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function findModel(Request $request)
    {
        $validated = $request->validate([
            'registrationNumber' => 'required|min:4',
        ]);
        try {
            $queryArray = ['registrationNumber' => !empty($request->registrationNumber) ? $request->registrationNumber : 'WN67DSO'];
            $api_data = $this->makeRequest( $queryArray );
            if ($api_data){
                $json_file = json_decode($api_data, true);
                if (isset($json_file['errors'])){
                    $message = $json_file['errors'][0]['detail'];
                    return Redirect::back()->withErrors(['error', $message]);
                } else {
                    return redirect(route('vehicle.detail', $queryArray));
                }
            } else {
                return Redirect::back()->withErrors(['error', 'Sorry record not found']);
            }
        } catch ( \Exception $e) {

            return Redirect::back()->withErrors(['error', 'Sorry Record not found.']);
        }

        //return view('frontend.vehicle.detail');
    }
    /**
     * Make Request
     */
    protected function makeRequest($queryArray){

        try{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($queryArray ));

            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers());

            $result = curl_exec($ch);

            if (curl_errno($ch)) {
                throw new \Exception('Error: ' . curl_error($ch));
            }

            curl_close($ch);
            return $result ;

        }catch(\Exception $e){
            Log::error($e->getMessage(), ['error' => $e]);
            Session::flash('err_message', 'OOPs! We cannot provide you with what you want now. Please, try again later or contact us if error persists.');
            Session::flash('alert-class', 'alert-danger');
            return [];
        }
    }

    /**
     * Headers
     */
    protected function headers(){
        return [
            'Accept: application/json',
            'X-API-KEY: ' . $this->key,
            'Content-Type: application/json',
            'X-Correlation-Id: string',
        ];
    }

    public function getSpareParts($id) {
        try {
            $make = Make::whereHas('spareParts')->with(['spareParts'])->whereId($id)->first();
            $spare_parts = $make->spareParts;
            return view('frontend.sparepart.spare_parts', compact('spare_parts'));
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sparePartsDetail($id) {
        try {
            $spare_part = SparePart::whereId($id)->first();
            if ($spare_part) {
                $suggestion = SparePart::whereCarId($spare_part->car_id)->take(3)->get();

                return view('frontend.sparepart.detail', compact('spare_part','suggestion'));
            } else {
                return Redirect::back()->withErrors([ 'Sorry Record not found.']);
            }
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = User::find($id);
        DB::beginTransaction();
        if ($user){
            $data = [
                'name' => !empty($request->name) ? $request->name : $user->name,
                'email' => !empty($request->email) ? $request->email : $user->email,
                'phone' => $request->phone,

            ];
            if(!empty($request->password)) {
                $data['password'] = bycrpt($request->password);
            }
            $user->update($data);
            DB::commit();
            return redirect(route('profile.index', $user->id))->with('success', 'Record has been updated.');
        }
        return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        /*} catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted.']);
        }*/
    }

    function profile($id) {
        $data = User::whereId($id)->first();
        return view('profile', compact('data'));
    }

}
