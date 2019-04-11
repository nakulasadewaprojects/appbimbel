<?php

namespace App\Http\Controllers\Auth;

use App\Tbsiswa;
use App\Tbdetailsiswa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


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
            'username' => ['required', 'string','min:3', 'max:255', 'unique:tbsiswa','regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'],
            'NamaLengkap' => ['required', 'string', 'max:255',],
            'NoTlpn' => ['required', 'string', 'max:255','unique:tbsiswa'],
            'gender' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:tbsiswa', 'regex:/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/'],
            'password' => [
                'required', 'string', 'min:8', 'confirmed',
                 'regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'
            ],
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
        $user=Tbsiswa::create([
            // 'NoIDSiswa' => $noidSiswa,
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
            'status' => '2',
            'tglregister' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $user->userData1 = Tbdetailsiswa::create([
            // 'NoIDMentor' => $noidmentor,
            'statusKomplit' => '0'
        ]);
        return $user;
    } 
    // public function register(Request $request)
    // {
    //     $this->validator($request->all())->validate();

    //     event(new Registered($user = $this->create($request->all())));
        
    //     $this->guard()->login($user);
        
    //     Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['idtbSiswa' => Auth::user()->idtbSiswa]);

    //     return $this->registered($request, $user)
    //                     ?: redirect($this->redirectPath());
    // } 
}
