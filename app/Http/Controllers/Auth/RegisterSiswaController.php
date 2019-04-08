<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\Auth;

use App\Tbsiswa;
// use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersSiswaUsers;
use Illuminate\Support\Carbon;


class RegisterSiswaController extends Controller
{
    // public function getLogin(){
    //     return view('login');
    // }
    // public function postLogin(){
    //     dd('login');
    // }
    //  public function getRegister(){
    //     return view('registerSiswa');
    // }
    use RegistersSiswaUsers;
    
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'NoIDSiswa' => ['unique:tbsiswa'],
            'username' => ['required', 'string','min:3', 'max:255', 'unique:tbsiswa','regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'],
            // 'first_name' => ['required', 'string', 'max:255'],
            // 'last_name' => ['string', 'max:255'],
            'NamaLengkap' => ['required', 'string', 'max:255'],
            'NoTlpn' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:tbsiswa', 'regex:/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/'],
            'password' => [
                'required', 'string', 'min:8', 'confirmed',
                 'regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'
            ],
        ]);
    }
    protected function create(array $data)
    {
        return Tbsiswa::create([
            // 'NoIDMentor' => $noidmentor,
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'NamaLengkap' => $data['NamaLengkap'],
            // 'nm_depan' => $data['first_name'],
            // 'nm_belakang' => $data['last_name'],
            'gender' => $data['gender'],
            'NoTlpn' => $data['NoTlpn'],
            'email' => $data['email'],
            // 'password' => Hash::make($data['password']),
            // 'tglregister' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'), //contoh
//            'tglregister' => Carbon::now()->format('Y-m-d H:i:s')
            // 'statusAktivasi' => '0',
            'status' => '1',
            'tglregister' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }  
}
