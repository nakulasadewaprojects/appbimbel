<?php



namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\Tbsiswa;


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
    public function update($idsiswa, Request $request)
    {
        DB::table('Tbsiswa')->where('idsiswa',$idsiswa)->update([
            'username' => $request['username'],
            // 'password' => Hash::make($data['password']),
            'NamaLengkap' => $request['NamaLengkap'],
            'alamat' => $request['alamat'],
            // 'nm_depan' => $data['first_name'],
            // 'nm_belakang' => $data['last_name'],
            'gender' => $request['gender'],
            'NoTlpn' => $request['NoTlpn'],
            'email' => $request['email']
            
         ] );
        return redirect('/dashboardsiswa');
    }
}
