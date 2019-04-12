<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\Tbsiswa;
use App\Tbdetailsiswa;

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
        $showing = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->first();
        $show = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('namaWali')->toArray();
        $show1 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('pendidikanSiswa')->toArray();
        $show2 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('jenjang')->toArray();
        $show3 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('prodiSiswa')->toArray();
        $show4 = array_merge($show,$show1,$show2,$show3);
        $counting = count(array_filter($show4,"is_null"));
        
        if($counting==4){
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '0']);
        }else if($counting==3){
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '1']);
        }else if($counting==2){
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '2']);
        }else if($counting==1){
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '3']);
        }else{
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '4']);
        }

        Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['idtbSiswa' => Auth::user()->idtbSiswa]);
        return view('dashboardsiswa',['isCompleted'=>$showing]);
        

    }
    public function profilesiswa()
    {
        $show = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('namaWali')->toArray();
        $show1 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('pendidikanSiswa')->toArray();
        $show2 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('jenjang')->toArray();
        $show3 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('prodiSiswa')->toArray();
        $show4 = array_merge($show,$show1,$show2,$show3);
        $counting = count(array_filter($show4,"is_null"));
        
        if($counting==4){
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '0']);
        }else if($counting==3){
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '1']);
        }else if($counting==2){
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '2']);
        }else if($counting==1){
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '3']);
        }else{
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '4']);
        }
        $showing = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->first();
        return view('profilesiswa',['isCompleted'=>$showing]);
    }
    public function update($idtbSiswa, Request $request)
    {
        $this->validate($request,[
            'username' => ['required', 'string','min:3', 'max:255', 'unique:tbsiswa,username,'.$idtbSiswa.',idtbSiswa','regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'],
            'NamaLengkap' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'NoTlpn' => ['required', 'string', 'max:255','unique:tbsiswa,NoTlpn,'.$idtbSiswa.',idtbSiswa'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:tbsiswa,email,'.$idtbSiswa.',idtbSiswa', 'regex:/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/']
         ]);
        DB::table('Tbsiswa')->where('idtbSiswa',$idtbSiswa)->update([
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

        //  $this->validate($request,[
        //     'namaWali' => ['required', 'string', 'max:255'],
        //     'pendidikanSiswa' => ['required'],
        //     'jenjang' => ['required'],
        //     'prodiSiswa' => ['required', 'string', 'max:255'],
        //  ]);
         DB::table('Tbdetailsiswa')->where('idtbSiswa',$idtbSiswa )->update([
            'namaWali' => $request['namaWali'],
            'pendidikanSiswa' => $request['pendidikanSiswa'],
            'jenjang'=>$request['jenjang'],
            'pendidikanSiswa'=>$request['pendidikanSiswa'],
            'prodiSiswa'=>$request['prodiSiswa']
        ]);
        return redirect('/profilesiswa');
    }

}