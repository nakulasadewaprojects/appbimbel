<?php

namespace App\Http\Controllers\Auth;

use App\Tbmentor;
use App\Aktivasimentor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Carbon;

class RegisterController extends Controller
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'NoIDMentor' => ['unique:tbmentor'],
            'username' => ['required', 'string','min:3', 'max:255', 'unique:tbmentor','regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:tbmentor', 'regex:/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/'],
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
        // $tahun = Carbon::now()->format('YY');
        // $bulan = Carbon::now()->format('m');
        // $noidmentor = 'M' . $bulan . $tahun;
        $user = Tbmentor::create([
            // 'NoIDMentor' => $noidmentor,
            'username' => $data['username'],
            'nm_depan' => $data['first_name'],
            'nm_belakang' => $data['last_name'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // 'tglregister' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'), //contoh
            'tglregister' => Carbon::now()->format('Y-m-d H:i:s'),
            'statusAktivasi' => '0',
            'statusTutor' => '1'
        ]);

        $user->userData = Aktivasimentor::create([
            // 'NoIDMentor' => $noidmentor,
            'statusLimit' => '1'
        ]);
        return $user;
    }
}
