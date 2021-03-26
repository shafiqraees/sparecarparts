<?php

namespace App\Http\Controllers;

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
        $this->url = env('DVLA_API_URL', '');
        $this->key = env('DVLA_API_KEY', '');

        $this->url .= $this->path;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.index');
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
            //dd($queryArray);
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
}
