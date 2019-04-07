<?php



namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;



class HomeSiswaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      
            $this->middleware('auth:siswa');
    
    }
        /**
         * Show the application dashboard.
         *
         * @return \Illuminate\Contracts\Support\Renderable
         */
    // public function index()
    // {
    //     return view('home');
    // }
    public function dashboardsiswa()
    {
        return view('dashboardsiswa');
    }
    public function profilesiswa()
    {
        return view('profilesiswa');
    }
}
