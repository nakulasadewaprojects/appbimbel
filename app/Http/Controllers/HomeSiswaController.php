<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use File;
use App\Tbsiswa;
use App\Tbdetailsiswa;
use Dotenv\Regex\Success;
class HomeSiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:siswa');
    }
    public function dashboardsiswa()
    {
        $mentor=DB::table('tbmentor')
                    ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                    ->get();
        $showing = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->first();
        $show = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('namaWali')->toArray();
        $show1 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('pendidikanSiswa')->toArray();
        $show2 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('jenjang')->toArray();
        $show3 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('prodiSiswa')->toArray();
        $show4 = array_merge($show, $show1, $show2, $show3);
        $counting = count(array_filter($show4, "is_null"));
        if ($counting == 4) {
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '0']);
        } else if ($counting == 3) {
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '1']);
        } else if ($counting == 2) {
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '2']);
        } else if ($counting == 1) {
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '3']);
        } else {
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '4']);
        }
        Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['idtbSiswa' => Auth::user()->idtbSiswa]);
        return view('dashboardsiswa', ['isCompleted' => $showing,'mentor'=>$mentor]);
        // return  $mentor;
    }
    public function profilesiswa()
    {
        $provinsi  = DB::table('provinsi')->get();
        $kabupaten = DB::table('kota_kabupaten')->get();
        $kecamatan = DB::table('kecamatan')->get();
        $kelurahan = DB::table('kelurahan')->get();
        $jenjang = DB::table('tbjenjangpendidikan')->get();
        $tingkatPendidikan = DB::table('tbtingkatpendidikan')->get();
        $show  = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('namaWali')->toArray();
        $show1 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('pendidikanSiswa')->toArray();
        $show2 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('jenjang')->toArray();
        $show3 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('prodiSiswa')->toArray(); 
        $show4 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('tingkatPendidikan')->toArray(); 
        $show5 = array_merge($show, $show1, $show2, $show3, $show4 );
        $counting = count(array_filter($show5, "is_null"));

        if ($counting == 5) {
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '0']);
        } else if ($counting == 4) {
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '1']);
        } else if ($counting == 3) {
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '2']);
        } else if ($counting == 2) {
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '3']);
        } else if($counting == 1) {
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '4']);
        } else {
        Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '5']);
    }
        $showing = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->first();
        return view('profilesiswa', ['isCompleted' => $showing , 'p' => $provinsi, 'b' => $kabupaten, 'c' => $kecamatan, 'd' => $kelurahan, 'j' => $jenjang, 'tp' => $tingkatPendidikan]);
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
    public function myprofilsiswa(){
        $siswa = DB::table('tbsiswa')->where('idtbSiswa', Auth::user()->idtbSiswa)->first();
        $showing = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->first();
        $show = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('namaWali')->toArray();
        $show1 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('pendidikanSiswa')->toArray();
        $show2 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('jenjang')->toArray();
        $show3 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('prodiSiswa')->toArray();
        $show4 = array_merge($show, $show1, $show2, $show3);
        $counting = count(array_filter($show4, "is_null"));
        if ($counting == 4) {
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '0']);
        } else if ($counting == 3) {
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '1']);
        } else if ($counting == 2) {
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '2']);
        } else if ($counting == 1) {
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '3']);
        } else {
            Tbdetailsiswa::where('idtbDetailSiswa', Auth::user()->idtbSiswa)->update(['statusKomplit' => '4']);
        }
        return view('myprofilesiswa' , ['ProfilSiswa' => $showing ]);

    }
    public function calendarsiswa(){
       
        return view('calendarsiswa');
    }
    public function update($idtbSiswa, Request $request)
    {
        // $this->validate($request, [
        // $this->validate($request, [
        //     // 'username' => ['required', 'string', 'min:3', 'max:255', 'unique:tbsiswa,username,' . $idtbSiswa . ',idtbSiswa', 'regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'],
        //     // 'NamaLengkap' => ['required', 'string', 'max:255'],
        //     'alamat' => ['required', 'string', 'max:255'],
        //     // 'gender' => ['required', 'string', 'max:255'],
        //     'NoTlpn' => ['required', 'string', 'max:255', 'unique:tbsiswa,NoTlpn,' . $idtbSiswa . ',idtbSiswa'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:tbsiswa,email,' . $idtbSiswa . ',idtbSiswa', 'regex:/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/']
        // ]);
  
        $Tbsiswa=Tbsiswa::find($idtbSiswa);
        $Tbsiswa->alamat=$request['alamat'];
        $Tbsiswa->NoTlpn=$request['NoTlpn'];
        $Tbsiswa->email= $request['email'];
        $Tbsiswa->provinsi= $request['provinsi'];
        $Tbsiswa->kota= $request['kabupaten'];
        $Tbsiswa->kecamatan= $request['kecamatan'];
        $Tbsiswa->kelurahan= $request['kelurahan'];
        $Tbsiswa->save();
        
        $Tbdetailsiswa=Tbdetailsiswa::find($idtbSiswa);
        $Tbdetailsiswa->namaWali=$request['namaWali'];
        $Tbdetailsiswa->pendidikanSiswa=$request['pendidikanSiswa'];
        $Tbdetailsiswa->jenjang= $request['jenjang'];
        $Tbdetailsiswa->tingkatPendidikan= $request['tingkatPendidikan'];
        $Tbdetailsiswa->prodiSiswa=$request['prodiSiswa'];
        $foto = $request->file('foto');
        $tujuan_upload = 'data_fileSiswa';
        if ($request->hasFile('foto')) {
            $show = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->value('fotoProfile');
            $nama_foto = time() . "_" . $foto->getClientOriginalName();
            $foto->move($tujuan_upload, $nama_foto);
            File::delete($tujuan_upload . '/' . $show);
            $Tbdetailsiswa->fotoProfile = $nama_foto;
        } else { }
        $Tbdetailsiswa->save();
        return redirect('/myprofilesiswa')->with('message', 'IT WORKS!');
      
      
    }
}