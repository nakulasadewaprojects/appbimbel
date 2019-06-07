<?php

namespace App\Http\Controllers\Auth;

use App\Tbdetailmentor;
use App\Tbmentor;
use App\Aktivasimentor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Carbon;
use DB;


class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest');
    }
    
    protected function guard()
    {
        return Auth::guard('web');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'NoIDMentor' => ['unique:tbmentor'],
            'username' => ['required', 'alpha_num','min:6', 'max:20', 'unique:tbmentor','regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'],
            'first_name' => ['required','min:3', 'max:100','regex:/^[a-zA-Z\s]*$/'],
            'gender' => ['required', 'numeric', 'min:1', 'max:1'],
            'email' => ['required', 'email', 'max:50', 'unique:tbmentor', 'regex:/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/'],
            'password' => [
                'required', 'string', 'min:8', 'confirmed','regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'
            ],
        ])->setAttributeNames([
            'first_name' => 'Nama Depan',
            'username' => 'Username'
        ]);
    }

    protected function create(array $data)
    {
        $nextId=DB::table('tbmentor')->max('idmentor') + 1;
        $user = Tbmentor::create([
            'username' => $data['username'],
            'nm_depan' => $data['first_name'],
            'nm_belakang' => $data['last_name'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tglregister' => Carbon::now()->format('Y-m-d H:i:s'),
            'statusAktivasi' => '0',
            'statusTutor' => '1'
        ]);

        $user->userData = Aktivasimentor::create([
           'statusLimit' => '1'
        ]);
        $user->userData1 = Tbdetailmentor::create([
            'statKomplit' => '0',
            'idmentor' => $nextId,
        ]);
        return $user;
    }
}
