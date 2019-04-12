<?php



namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tbdetailmentor;
use DB;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    
        $this->middleware(['auth', 'verified']);
        
    }
        /**
         * Show the application dashboard.
         *
         * @return \Illuminate\Contracts\Support\Renderable
         */
    public function index()
    {
        return view('home');
    }
    public function dashboard()
    {
        Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['idmentor' => Auth::user()->idmentor]);
        $show = DB::table('tbdetailmentor')->where('idmentor', Auth::user()->idmentor)->first();
        return view('dashboard',['isCompleted'=>$show]);
    }
    public function profile()
    {
        return view('profile');
    }
    
    public function update($idmentor, Request $request)
    {
        $this->validate($request,[
            'username' => ['required', 'alpha_num','min:6', 'max:50', 'unique:tbmentor,username,'.$idmentor.',idmentor','regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'],
            'NamaDepan' => ['required', 'string', 'max:255'],
            'NamaBelakang' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            // 'gender' => ['required', 'string', 'max:255'],
            'noTlpn' => ['required', 'string', 'max:255', 'unique:tbmentor,noTlpn,'.$idmentor.',idmentor'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:tbmentor,email,'.$idmentor.',idmentor', 'regex:/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/']
         ]);
         
        DB::table('tbmentor')->where('idmentor',$idmentor)->update([
            'username' => $request['username'],
            // 'password' => Hash::make($data['password']),
            // 'NamaLengkap' => $request['NamaLengkap'],
            'alamat' => $request['alamat'],
            'nm_depan' => $request['NamaDepan'],
            'nm_belakang' => $request['NamaBelakang'],
            'gender' => $request['gender'],
            'noTlpn' => $request['noTlpn'],
            // 'email' => $request['email']
            
         ]);
        return redirect('/profile');
    }
}
