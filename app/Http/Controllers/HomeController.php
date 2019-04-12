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
        // Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['idmentor' => Auth::user()->idmentor]);
        // $show = DB::table('tbdetailmentor')->where('idmentor', Auth::user()->idmentor)->first();
        // return view('dashboard',['isCompleted'=>$show]);
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

         // menyimpan data file yang diupload ke variabel $file
        // $foto = $request->foto('foto');
        // $fileKTP=$request->fileKTP('fileKTP');
        // $fileIjazah=$request->file('fileIjazah');
        // $nama_foto = time()."_".$foto->getClientOriginalName();
        // $nama_fileKTP=time()."_".$fileKTP->getClientOriginalName();
        // $nama_fileIjazah=time()."_".$fileIjazah->getClientOriginalName();
        
        //  // isi dengan nama folder tempat kemana file diupload
		// $tujuan_upload = 'data_file';
        // $foto->move($tujuan_upload,$nama_foto);
        // $fileKTP->move($tujuan_upload,$nama_fileKTP);
        // $fileIjazah->move($tujuan_upload, $nama_fileIjazah);
        
        DB::table('tbdetailmentor')->where('idmentor',$idmentor)->update([
            'pendidikanTerakhir' => $request['pendidikanTerakhir'],
            'statusPendidikan' => $request['statusPendidikan'],
            // 'foto' => $request['foto'];
            'No_Identitas' => $request['No_Identitas']
            // 'fileKTP' => $request['fileKTP'];
            // 'fileIjazah' => $request['fileIjazah']

        ]);
 
        return redirect('/profile');
    }
}
