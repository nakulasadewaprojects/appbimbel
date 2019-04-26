<?php



namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tbdetailmentor;
use App\Tbmentor;
use File;
use DB;
use Image;

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
        $showing = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
        $show = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->pluck('pendidikanTerakhir')->toArray();
        $show1 = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->pluck('statusPendidikan')->toArray();
        $show2 = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->pluck('foto')->toArray();
        $show3 = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->pluck('No_Identitas')->toArray();
        $show4 = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->pluck('fileKTP')->toArray();
        $show5 = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->pluck('fileIjazah')->toArray();
        $show6 = array_merge($show, $show1, $show2, $show3, $show4, $show5);
        $counting = count(array_filter($show6, "is_null"));

        if ($counting == 6) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '0']);
        } else if ($counting == 5) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '1']);
        } else if ($counting == 4) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '2']);
        } else if ($counting == 3) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '3']);
        } else if ($counting == 2) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '4']);
        } else if ($counting == 1) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '5']);
        } else {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '6']);
        }
        Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['idmentor' => Auth::user()->idmentor]);
        return view('dashboard', ['isCompleted' => $showing]);
    }

    public function myprofile()
    {
        $mentor = DB::table('tbmentor')->where('idmentor', Auth::user()->idmentor)->first();
        $showing = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
        $show = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->pluck('pendidikanTerakhir')->toArray();
        $show1 = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->pluck('statusPendidikan')->toArray();
        $show2 = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->pluck('foto')->toArray();
        $show3 = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->pluck('No_Identitas')->toArray();
        $show4 = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->pluck('fileKTP')->toArray();
        $show5 = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->pluck('fileIjazah')->toArray();
        $show6 = array_merge($show, $show1, $show2, $show3, $show4, $show5);
        $counting = count(array_filter($show6, "is_null"));

        if ($counting == 6) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '0']);
        } else if ($counting == 5) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '1']);
        } else if ($counting == 4) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '2']);
        } else if ($counting == 3) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '3']);
        } else if ($counting == 2) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '4']);
        } else if ($counting == 1) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '5']);
        } else {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '6']);
        }
        return view('myProfile', ['isCompleted' => $showing, 'm' => $mentor]);
    }

    public function profile()
    {
        $show = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
        $provinsi  = DB::table('provinsi')->get();
        $kabupaten = DB::table('kota_kabupaten')->get();
        $kecamatan = DB::table('kecamatan')->get();
        $kelurahan = DB::table('kelurahan')->get();
        return view('profile', ['isCompleted' => $show, 'p' => $provinsi, 'b' => $kabupaten, 'c' => $kecamatan, 'd' => $kelurahan]);
        //return  $provinsi;
    }

    public function getKabupaten($id)
    {
        $kabupaten = DB::table("kota_kabupaten")->where("provinsi_id", $id)->pluck("nama", "id");
        return json_encode($kabupaten);
    }
    public function getKecamatan($id)
    {
        $kecamatan = DB::table("kecamatan")->where("kab_kota_id", $id)->pluck("nama", "id");
        return json_encode($kecamatan);
    }
    public function getKelurahan($id)
    {
        $kelurahan = DB::table("kelurahan")->where("kecamatan_id", $id)->pluck("nama", "id");
        return json_encode($kelurahan);
    }

    public function update($idmentor, Request $request)
    {
        $this->validate($request, [
            'username' => ['required', 'alpha_num', 'min:6', 'max:50', 'unique:tbmentor,username,' . $idmentor . ',idmentor', 'regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'],
            'NamaDepan' => ['required', 'string', 'max:255'],
            'NamaBelakang' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            // 'gender' => ['required', 'string', 'max:255'],
            'noTlpn' => ['required', 'string', 'max:255', 'unique:tbmentor,noTlpn,' . $idmentor . ',idmentor'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:tbmentor,email,'.$idmentor.',idmentor', 'regex:/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/']
        ]);

        $Tbmentor = Tbmentor::find($idmentor);
        $Tbmentor->username = $request['username'];
        $Tbmentor->alamat = $request['alamat'];
        $Tbmentor->provinsi = $request['provinsi'];
        $Tbmentor->kota = $request['kabupaten'];
        $Tbmentor->kecamatan = $request['kecamatan'];
        $Tbmentor->kelurahan = $request['kelurahan'];
        $Tbmentor->nm_depan = $request['NamaDepan'];
        $Tbmentor->nm_belakang = $request['NamaBelakang'];
        $Tbmentor->gender = $request['gender'];
        $Tbmentor->noTlpn = $request['noTlpn'];
        $Tbmentor->save();

        //  $this->validate($request, [
        // 	'foto' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        //     'fileIjazah'=>'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        //     'fileKTP'=>'required|file|image|mimes:jpeg,png,jpg|max:2048',
        //     'pendidikanTerakhir'=>'required',
        //     'statusPendidikan'=>'required',
        //     'No_Identitas'=>'required'
        // ]);
        $Tbdetailmentor = Tbdetailmentor::find($idmentor);
        $Tbdetailmentor->pendidikanTerakhir = $request['pendidikanTerakhir'];
        $Tbdetailmentor->statusPendidikan = $request['statusPendidikan'];
        $foto = $request->file('foto');
        $tujuan_upload = 'data_file';
        if ($request->hasFile('foto')) {
            $show = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->value('foto');
            
            // $nama_foto = time() . "_" . $foto->getClientOriginalName();
            $nama_foto = time().'.'.$foto->getClientOriginalExtension();
            $tujuan_upload2 = public_path('/data_file2');
            $thumb_img = Image::make($foto->getRealPath())->resize(100, 100);
            $thumb_img->save($tujuan_upload2.'/'.$nama_foto,80);
            File::delete($tujuan_upload2 . '/' . $show);
            $tujuan_upload2 = public_path('/data_file') ;
            $foto->move($tujuan_upload2, $nama_foto);
            File::delete($tujuan_upload2 . '/' . $show);
            $Tbdetailmentor->foto = $nama_foto;
        } else { }

        $fileKTP = $request->file('fileKTP');
        if ($request->hasFile('fileKTP')) {
            $show = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->value('fileKTP');
            $namafileKTP = time() . "_" . $fileKTP->getClientOriginalName();
            $fileKTP->move($tujuan_upload, $namafileKTP);
            File::delete($tujuan_upload . '/' . $show);
            $Tbdetailmentor->fileKTP = $namafileKTP;
        } else { }
        $fileIjazah = $request->file('fileIjazah');
        if ($request->hasFile('fileIjazah')) {
            $show = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->value('fileIjazah');
            $namafileIjazah = time() . "_" . $fileIjazah->getClientOriginalName();
            $fileIjazah->move($tujuan_upload, $namafileIjazah);
            File::delete($tujuan_upload . '/' . $show);
            $Tbdetailmentor->fileIjazah = $namafileIjazah;
        } else { }
        $Tbdetailmentor->No_Identitas = $request['No_Identitas'];
        $Tbdetailmentor->save();
        return redirect('/myProfile');
    }
}
