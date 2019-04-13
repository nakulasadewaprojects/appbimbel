<?php



namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\Tbdetailmentor;
use App\Tbmentor;

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
        $show = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
        return view('dashboard',['isCompleted'=>$show]);
    }
    public function profile()
    {
        $show = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
        return view('profile',['isCompleted'=>$show]);
    }
    
    public function update($idmentor, Request $request)
    {
        // $this->validate($request,[
        //     'username' => ['required', 'alpha_num','min:6', 'max:50', 'unique:tbmentor,username,'.$idmentor.',idmentor','regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'],
        //     'NamaDepan' => ['required', 'string', 'max:255'],
        //     'NamaBelakang' => ['required', 'string', 'max:255'],
        //     'alamat' => ['required', 'string', 'max:255'],
        //     // 'gender' => ['required', 'string', 'max:255'],
        //     'noTlpn' => ['required', 'string', 'max:255', 'unique:tbmentor,noTlpn,'.$idmentor.',idmentor'],
        //     // 'email' => ['required', 'string', 'email', 'max:255', 'unique:tbmentor,email,'.$idmentor.',idmentor', 'regex:/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/']
        //  ]);
         
         $Tbmentor=Tbmentor::find($idmentor);
         $Tbmentor->username=$request['username'];
         $Tbmentor->alamat=$request['alamat'];
         $Tbmentor->nm_depan=$request['NamaDepan'];
         $Tbmentor->nm_belakang=$request['NamaBelakang'];
         $Tbmentor->gender=$request['gender'];
         $Tbmentor->noTlpn=$request['noTlpn'];
         $Tbmentor ->save();

        //  $this->validate($request, [
		// 	'foto' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
		// ]);
        $Tbdetailmentor= Tbdetailmentor::find($idmentor);
        $Tbdetailmentor->pendidikanTerakhir=$request['pendidikanTerakhir'];
        $Tbdetailmentor->statusPendidikan=$request['statusPendidikan'];
        // $foto = $request->file('foto');
        // $nama_foto = time()."_".$foto->getClientOriginalName();
        // $tujuan_upload = 'data_file';
        // $foto->move($tujuan_upload,$nama_foto);
        // $Tbdetailmentor->foto=$nama_foto;
        $Tbdetailmentor->No_Identitas=$request['No_Identitas'];
        // $fileKTP= $request->file('fileKTP');
        // $namafileKTP=time()."_".$fileKTP->getClientOriginalName();
        // $fileKTP->move($tujuan_upload,$namafileKTP);
        // $Tbdetailmentor->fileKTP=$namafileKTP;
        $Tbdetailmentor->save();
        
        return redirect('/profile');
    }
}
