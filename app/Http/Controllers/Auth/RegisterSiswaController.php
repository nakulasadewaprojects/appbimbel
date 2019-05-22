<?php

namespace App\Http\Controllers\Auth;

use App\Tbsiswa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Tbdetailsiswa;
use DB;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;



class RegisterSiswaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboardsiswa';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function guard()
    {
        return Auth::guard('siswa');
    }

   

    public function showRegisterForm()
    {
        return view('auth.registersiswa');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'NoIDSiswa' => ['unique:tbsiswa'],
            'username' => ['alpha_num','min:6', 'max:20', 'unique:tbsiswa','regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'],
            'NamaLengkap' => ['string', 'max:255',],
            'NoTlpn' => ['numeric', 'unique:tbsiswa'],
            'gender' => ['numeric','min:1', 'max:1'],
            'email' => ['string', 'email', 'max:50', 'unique:tbsiswa', 'regex:/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/'],
            'password' => [
                'required', 'string', 'min:8', 'confirmed',
                 'regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'
            ],
        ])->setAttributeNames([
            'NoTlpn' => 'Nomor Telepon',
            'NamaLengkap' => 'Nama Lengkap',
            'username' => 'Username'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $tahun = Carbon::now()->isoFormat('YY');
        $bulan = Carbon::now()->format('m');
        $noidsiswa = 'S' . $bulan . $tahun;
        $nextId=DB::table('tbsiswa')->max('idtbSiswa') + 1;
        if(strlen((string)$nextId)==1){
            $noidsiswa1=$noidsiswa.'0000'.$nextId;
        }
        elseif(strlen((string)$nextId)==2){
            $noidsiswa1=$noidsiswa.'000'.$nextId;
        }
        elseif(strlen((string)$nextId)==3){
            $noidsiswa1=$noidsiswa.'00'.$nextId;
        }
        elseif(strlen((string)$nextId)==4){
            $noidsiswa1=$noidsiswa.'0'.$nextId;
        }
        elseif(strlen((string)$nextId)==5){
            $noidsiswa1=$noidsiswa.$nextId;
        }

        $user = Tbsiswa::create([
           'username' => $data['username'],
           'NoIDSiswa' => $noidsiswa1,
            'password' => Hash::make($data['password']),
            'NamaLengkap' => $data['NamaLengkap'],
            'gender' => $data['gender'],
            'NoTlpn' => $data['NoTlpn'],
            'email' => $data['email'],
            'status' => '2',
            'tglregister' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        // $nextIdtbdetailsiswa=DB::table('tbdetailsiswa')->max('idtbDetailSiswa') + 1;

        $user->userData1 = Tbdetailsiswa::create([
            'idtbSiswa'=> $nextId,
            'statusKomplit' => '0'
        ]);
        return $user;  
    }  
}
