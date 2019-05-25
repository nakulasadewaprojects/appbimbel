<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tbdetailmentor;
use App\Tbmentor;
use File;
use DB;
use Image;
use Illuminate\Support\Carbon;
use function Opis\Closure\serialize;

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
    public function detailmentor()
    {   
        return view ('detailmentor');
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
        $show6 = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->pluck('pengalaman')->toArray();
        $show7 = array_merge($show, $show1, $show2, $show3, $show4, $show5, $show6 );
        $counting = count(array_filter($show7, "is_null"));

        if ($counting == 7) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '0']);
        } else if ($counting == 6) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '1']);
        } else if ($counting == 5) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '2']);
        } else if ($counting == 4) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '3']);
        } else if ($counting == 3) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '4']);
        } else if ($counting == 2) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '5']);
        } else if ($counting == 1) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '6']);
        } else {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '7']);
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
        $show6 = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->pluck('pengalaman')->toArray();
        $show7 = array_merge($show, $show1, $show2, $show3, $show4, $show5, $show6);
        $counting = count(array_filter($show7, "is_null"));
        if ($counting == 7) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '0']);
        } else if ($counting == 6) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '1']);
        } else if ($counting == 5) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '2']);
        } else if ($counting == 4) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '3']);
        } else if ($counting == 3) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '4']);
        } else if ($counting == 2) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '5']);
        } else if ($counting == 1) {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '6']);
        } else {
            Tbdetailmentor::where('idtbRiwayatTutor', Auth::user()->idmentor)->update(['statKomplit' => '7']);
        }
        return view('myProfile', ['isCompleted' => $showing, 'm' => $mentor]);
    }
    public function profile()
    {
        $show = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
        $prodi=DB::table('tbdetailmentor')->where('idmentor', Auth::user()->idmentor)->value('prodi');
        $provinsi  = DB::table('provinsi')->orderBy('nama', 'asc')->get();
        $kabupaten = DB::table('kota_kabupaten')->where('provinsi_id', Auth::user()->provinsi )->get();
        $kecamatan = DB::table('kecamatan')->where('kab_kota_id', Auth::user()->kota )->get();        
        $kelurahan = DB::table('kelurahan')->where('kecamatan_id', Auth::user()->kecamatan )->get();
        $pete = DB::table('tbjenjangpendidikan')->get();
        $prodimentor = DB::table('mastermatpel')->get();
        $prodi2=implode(' ',[$prodi]);
        return view('profile', ['getprodi'=>$prodi2,'isCompleted' => $show, 'p' => $provinsi, 'b' => $kabupaten, 'c' => $kecamatan, 'd' => $kelurahan,'pt'=>$pete, 'prodi'=>$prodimentor]);
       }

    public function jadwal(){
        $mentor = DB::table('tbmentor')->where('idmentor', Auth::user()->idmentor)->first();
        $showing = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
        return view('jadwal' , ['isCompleted' => $showing, 'm' => $mentor]);
    }
    public function approvalmentor(){
        $mentor = DB::table('tbmentor')->where('idmentor', Auth::user()->idmentor)->first();
        $showing = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
        $jadwalBimb=DB::table('siswabimbel')
            ->join('scedulebimbel', 'siswabimbel.NoIDBimbel', '=', 'scedulebimbel.NoIDBimbel')
            ->join('sceduletutor', 'sceduletutor.NoIDBimbel', '=', 'scedulebimbel.NoIDBimbel')
            ->join('tbsiswa','tbsiswa.NoIDSiswa','=','siswabimbel.NoIDSiswa')
            ->join('tbdetailsiswa','tbdetailsiswa.idtbSiswa','=','tbsiswa.idtbSiswa')      
            ->join('tbmentor','tbmentor.NoIDMentor','=','siswabimbel.NoIDTutor')
            ->where('siswabimbel.NoIDTutor', Auth::user()->NoIDMentor)->get();
        return view('approvalmentor' , ['isCompleted' => $showing, 'm' => $mentor, 'jadwal'=>$jadwalBimb]);
    }
    public function detailApprovalMentor($id){
        $siswa = DB::table('tbmentor')->where('idmentor', Auth::user()->idmentor)->first();
        $showing = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
        $detailBimbelMentor=DB::table('siswabimbel')
        ->join('scedulebimbel', 'siswabimbel.NoIDBimbel', '=', 'scedulebimbel.NoIDBimbel')
        ->join('sceduletutor', 'sceduletutor.NoIDBimbel', '=', 'scedulebimbel.NoIDBimbel')
        ->join('tbsiswa','tbsiswa.NoIDSiswa','=','siswabimbel.NoIDSiswa')
        ->join('tbmentor','tbmentor.NoIDMentor','=','siswabimbel.NoIDTutor') 
        ->join('tbdetailsiswa','tbdetailsiswa.idtbSiswa','=','tbsiswa.idtbSiswa')      
        ->where('siswabimbel.NoIDBimbel', $id)->first();
        return view('detailApprovalMentor' , ['ProfilSiswa' => $showing,'s'=>$siswa] , ['isCompleted' => $showing,'s'=>$siswa, 'detail'=>$detailBimbelMentor]);
        
    }
    public function TerimaTolakBimbel(Request $request){
        if($request['submit']=='terima'){
            $a= 2; 
        }else{
            $a=3;
        }
        
        DB::table('siswabimbel')->where('NoIDBimbel',$request->id)->update([
            'statusBimbel' => $a
          ]);
          return redirect('/approvalmentor');

    }
    public function paketbimbel(){
        $mentor = DB::table('tbmentor')->where('idmentor', Auth::user()->idmentor)->first();
        $showing = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
        $getprodiMentor = DB::table('tbdetailmentor')
        ->join('tbmentor','tbmentor.idmentor','=','tbdetailmentor.idtbRiwayatTutor')      
        ->where('idtbRiwayatTutor',  Auth::user()->idmentor)->value('prodi');
          $getexplodeMentor = explode(', ',$getprodiMentor);
         
        return view('paketbimbel' , ['isCompleted' => $showing, 'm' => $mentor,'prodiMentor'=>$getexplodeMentor]);
    }
    public function datapaket(){
        $mentor = DB::table('tbmentor')->where('idmentor', Auth::user()->idmentor)->first();
        $showing = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
        $datapaket = DB::table('paketbimbel')->get();     
        return view('datapaket' , ['isCompleted' => $showing, 'm' => $mentor, 'paketbimbel' => $datapaket]);
    }
    public function hapus($id){
    DB::table('paketbimbel')->where('idpaket',$id)->delete();
	return redirect('/datapaket');
    }   
    public function edit($id){
    $getprodiMentor = DB::table('tbdetailmentor')
    ->join('tbmentor','tbmentor.idmentor','=','tbdetailmentor.idtbRiwayatTutor')      
    ->where('idtbRiwayatTutor',  Auth::user()->idmentor)->value('prodi');
        $getexplodeMentor = explode(', ',$getprodiMentor);
    $prodi=DB::table('paketbimbel')->where('idpaket', $id)->value('matpel');
    $showing = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
    $paket = DB::table('paketbimbel')->where('idpaket', $id)->first();
    $prodimentor = DB::table('mastermatpel')->get();
    $prodi2=implode(' ',[$prodi]);
    // return $getexplodeMentor;
    return view('editpaket', ['prodiMentor'=>$getexplodeMentor,'prodi'=>$prodimentor,'getprodi'=>$prodi2,'isCompleted' => $showing,'paketbimbel' => $paket]);
    }   
    public function updatepaket(Request $request){	
        $prodi=$request->matpel;
        $prodi2=implode(', ',$prodi);
        
	DB::table('paketbimbel')->where('idpaket',$request->id)->update([
		'nmpaket' => $request->nama,
		'harga' => $request->harga,
		'durasi' => $request->durasi,
        'hari' => $request->hari,
        'wkt_mulai' => $request->waktumulai,
        'wkt_akhir' => $request->waktuakhir,
        'matpel' => $prodi2,
        'keterangan' => $request->keterangan,
        'statusPaket' => $request->statuspaket,
	]);
	// alihkan halaman ke halaman pegawai
	return redirect('/datapaket');
    }
    public function inputpaketbimbel(Request $request){
        if($request->hasAny('hari')){
            $hari=$request['hari'];
            $hari2=implode(', ',$hari);
            $h= $hari2; 
          }else{
            $hari=$request['hari'];
           $h= $hari; 
          }
        if($request->hasAny('matpel')){
            $matpel=$request['matpel'];
            $matpel2=implode(', ',$matpel);
            $m= $matpel2; 
          }else{
            $matpel=$request['matpel'];
           $m= $matpel; 
          }
        if($request['waktuMulai']==NULL){
            $jam=$request->waktuMulai;
        }else{
           $jam=Carbon::parse($request['waktuMulai'])->format('H:i:s'); 
        }
        if($request['waktuAkhir']==NULL){
            $jamAkhir=$request->waktuAkhir;
        }else{
           $jamAkhir=Carbon::parse($request['waktuAkhir'])->format('H:i:s'); 
        }
        DB::table('paketbimbel')->insert([
        'NoIDMentor'=>$request->id,
        'nmpaket'=>$request->nama,
        'harga'=>$request->harga,
        'durasi'=>$request->durasi,
        'hari'=>$h,
        'wkt_mulai'=>$jam,
        'wkt_akhir'=>$jamAkhir,
        'matpel'=>$m,
        'keterangan'=>$request->keterangan,
        'statusPaket'=>'1',
        ]);
      return redirect('/dashboard');

    }

    public function payment(){
        $mentor = DB::table('tbmentor')->where('idmentor', Auth::user()->idmentor)->first();
        $showing = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
        return view('payment' , ['isCompleted' => $showing, 'm' => $mentor]);
    }

    public function report(){
        $mentor = DB::table('tbmentor')->where('idmentor', Auth::user()->idmentor)->first();
        $showing = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
        return view('report' , ['isCompleted' => $showing, 'm' => $mentor]);
    }
    public function inputreport(Request $request){
        DB::table('hasilpembelajaran')->insert([
            'IdMentor'=>$request->id,
            'TglBimbel'=>$request->tanggalbimbel,
            'wkt_mulai'=>$request->waktuMulai,
            'wkt_selesai'=>$request->waktuAkhir,
            'MatPel'=>$request->matpel,
            'ModulMatpel'=>$request->modulmatpel,
            'Aktifitas'=>$request->aktivitas,
            'Catatan'=>$request->catatan,
            ]);
            return redirect('/dashboard');
    }
    public function datareport(){
        $mentor = DB::table('tbmentor')->where('idmentor', Auth::user()->idmentor)->first();
        $showing = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
        return view('datareport' , ['isCompleted' => $showing, 'm' => $mentor]);
    }
    public function exportexcel(){
        $mentor = DB::table('tbmentor')->where('idmentor', Auth::user()->idmentor)->first();
        $showing = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
        return view('exportexcel' , ['isCompleted' => $showing, 'm' => $mentor]);
    }
    public function tutorial(){
        $mentor = DB::table('tbmentor')->where('idmentor', Auth::user()->idmentor)->first();
        $showing = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
        $prodimentor = DB::table('mastermatpel')->get();
        $jenjangPendidikan = DB::table('tbjenjangpendidikan')->get();
        $noIDMentor=DB::table('tbmentor')->where('idmentor', Auth::user()->idmentor)->value('NoIDMentor');
        // return $prodimentor;
        return view('tutorial' , ['isCompleted' => $showing, 'm' => $mentor, 'matpel' => $prodimentor, 'jenjang' => $jenjangPendidikan, 'noId'=>$noIDMentor]);
        // return $noIDMentor;
    }

    public function inputTutorial(Request $request){
            $tglentry=Carbon::now();
            $modul = $request->file('modul');
            $nama_modul = time().'.'.$modul->getClientOriginalExtension();
            $tujuan_upload = public_path('/data_modul') ;
            $modul->move($tujuan_upload, $nama_modul);
            
        DB::table('modulsiswa')->insert([
            'nama_modul'=>$request->nama,
            'tgl_upload'=>$tglentry,
            'mentor'=>$request->id,
            'file'=>$nama_modul,
            'jenjangpendidikan'=>$request->jenjang,
            'matpel'=>$request->matpel
        ]);
      return redirect('/datatutorial');
    }
    public function datatutorial(){
        $mentor = DB::table('tbmentor')->where('idmentor', Auth::user()->idmentor)->first();
        $showing = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
        $datatutorial = DB::table('modulsiswa')->get(); 
        return view('datatutorial' , ['isCompleted' => $showing, 'm' => $mentor, 'tutorial' => $datatutorial]);
    }
    public function hapustutorial($id){
        DB::table('modulsiswa')->where('idmodul',$id)->delete();
        return redirect('/datatutorial');
        } 
       
    public function edittutorial($id){
    $tutorial = DB::table('modulsiswa')->where('idmodul', $id)->first();
    $showing = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
    $prodi = DB::table('mastermatpel')->get();
    $jenjang = DB::table('tbjenjangpendidikan')->get();
	return view('edittutorial',['isCompleted' => $showing,'tutorial' => $tutorial, 'matpel' => $prodi, 'jenjang' => $jenjang]);
	// return $tutorial;
    }
    public function updatetutorial(Request $request){	      
	DB::table('modulsiswa')->where('idmodul',$request->id)->update([
		'nama_modul' => $request->nama,
		'file' => $request->modul,
		'jenjangpendidikan' => $request->jenjang,
        'matpel' => $request->matpel,
	]);
	// alihkan halaman ke halaman pegawai
	return redirect('/datatutorial');
    }
    public function multimedia(){
        $mentor = DB::table('tbmentor')->where('idmentor', Auth::user()->idmentor)->first();
        $showing = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
        return view('multimedia' , ['isCompleted' => $showing, 'm' => $mentor]);
    }
    public function datamultimedia(){
        $mentor = DB::table('tbmentor')->where('idmentor', Auth::user()->idmentor)->first();
        $showing = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', Auth::user()->idmentor)->first();
        return view('datamultimedia' , ['isCompleted' => $showing, 'm' => $mentor]);
    }
    
    public function update($idmentor, Request $request)
    {
        $this->validate($request, [
            // 'username' => ['required', 'alpha_num', 'min:6', 'max:50', 'unique:tbmentor,username,' . $idmentor . ',idmentor', 'regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'],
            'noTlpn' => ['numeric', 'digits_between:10,15', 'unique:tbmentor,noTlpn,' . $idmentor . ',idmentor'],
            'alamat' => ['max:255','regex:/[ .,()\-\/\w+]/'],
            // // 'email' => ['required', 'string', 'email', 'max:255', 'unique:tbmentor,email,'.$idmentor.',idmentor', 'regex:/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/']
        ]);
        $Tbmentor = Tbmentor::find($idmentor);
        $Tbmentor->username = $request['username'];
        $Tbmentor->alamat = $request['alamat'];
        $Tbmentor->provinsi = $request['provinsi'];
        $Tbmentor->kota = $request['kabupaten'];
        $Tbmentor->kecamatan = $request['kecamatan'];
        $Tbmentor->kelurahan = $request['kelurahan'];
        $Tbmentor->noTlpn = $request['noTlpn'];
        $Tbmentor->save();

         $this->validate($request, [
        	'foto' => 'file|image|mimes:jpeg,png,jpg|max:2048',
            'fileIjazah'=>'file|mimes:pdf|max:2048',
            'fileKTP'=>'file|image|mimes:jpeg,png,jpg|max:2048',
            'No_Identitas'=>'numeric'
        ]);
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
            // $namafileKTP = time() . "_" . $fileKTP->getClientOriginalName();
            $namafileKTP = time() . "_" . $fileKTP->getClientOriginalName();
            $tujuan_upload2 = public_path('/data_file2');
            $thumb_img = Image::make($fileKTP->getRealPath())->resize(100, 100);
            $thumb_img->save($tujuan_upload2.'/'.$namafileKTP,80);
            File::delete($tujuan_upload2 . '/' . $show);
            $tujuan_upload2 = public_path('/data_file') ;

            $fileKTP->move($tujuan_upload2, $namafileKTP);
            File::delete($tujuan_upload2 . '/' . $show);
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
        $Tbdetailmentor->pengalaman = $request['pengalaman'];
       if($request->hasAny('prodi')){
            $prodi=$request['prodi'];
            $prodi2=implode(', ',$prodi);
            $Tbdetailmentor->prodi = $prodi2; 
        }else{
            $prodi=$request['prodi'];
            $Tbdetailmentor->prodi = $prodi; 
        }
        $Tbdetailmentor->save();
        return redirect('/myProfile')->with('message','IT WORKS!');      
        
    }
}