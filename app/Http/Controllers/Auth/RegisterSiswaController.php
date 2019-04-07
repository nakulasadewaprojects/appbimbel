<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\Auth;

use App\Tbsiswa;
// use Illuminate\Http\Request;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;


class RegisterSiswaController extends Controller
{
    
    public function showRegisterForm()
    {
        return view('auth.registersiswa');
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    protected $redirectTo = '/dashboardsiswa';

    protected function guard()
    {
        return Auth::guard('siswa');
    }

    public function __construct()
    {
        $this->middleware('guest');
    }



    protected function registered(Request $request, $user)
    {
        //
    }

    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/dashboard';
    }    

   
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'NoIDSiswa' => ['unique:tbsiswa'],
            'username' => ['required', 'string','min:3', 'max:255', 'unique:tbsiswa','regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'],
            'NamaLengkap' => ['required', 'string', 'max:255'],
            'NoTlpn' => ['required', 'string', 'max:255','unique:tbsiswa'],
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
