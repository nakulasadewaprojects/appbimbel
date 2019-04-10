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
    public function update($idtbsiswa, Request $request)
    {
        $this->validate($request,[
            // 'NoIDSiswa' => $noidSiswa,
            // 'NoIDSiswa' => ['unique:tbsiswa'],
            'username' => ['required', 'string','min:3', 'max:255', 'unique:tbsiswa,username,'.$idtbsiswa.',idtbSiswa','regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'],
            'NamaLengkap' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'NoTlpn' => ['required', 'string', 'max:255','unique:tbsiswa,NoTlpn,'.$idtbsiswa.',idtbSiswa'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:tbsiswa,email,'.$idtbsiswa.',idtbSiswa', 'regex:/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/']
         ]);
        DB::table('Tbsiswa')->where('idtbSiswa',$idtbsiswa)->update([
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
        return redirect('/profilesiswa');
    }
}