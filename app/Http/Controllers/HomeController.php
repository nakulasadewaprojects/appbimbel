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
        DB::table('tbmentor')->where('idmentor',$idmentor)->update([
            'username' => $request['username'],
            // 'password' => Hash::make($data['password']),
            // 'NamaLengkap' => $request['NamaLengkap'],
            'alamat' => $request['alamat'],
            'nm_depan' => $request['nm_depan'],
            'nm_belakang' => $request['nm_belakang'],
            'gender' => $request['gender'],
            'noTlpn' => $request['noTlpn'],
            // 'email' => $request['email']
            
         ] );
        return redirect('/profile');
    }
}
