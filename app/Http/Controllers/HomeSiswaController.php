<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use File;
use App\Tbsiswa;
use App\Tbdetailsiswa;
use Illuminate\Support\Carbon;
use Dotenv\Regex\Success;
use Image;

class HomeSiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:siswa');
    }
    public function detailmentor($id)
    {   
        $showing = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->first();
        $showmentor=DB::table('tbmentor')
                    ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                    ->where('tbmentor.idmentor', $id)->first();
        // $showing = DB::table('tbdetailmentor')->where('idmentor', $id)->first();        
        return view ('detailmentor',['showmentor' => $showmentor,'isCompleted' => $showing]);
    }
    public function formAjukan($id){
      $showing = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->first();
      $showsiswa=DB::table('tbsiswa')
      ->join('tbdetailsiswa','tbsiswa.idtbSiswa','=','tbdetailsiswa.idtbSiswa')
      ->where('tbsiswa.idtbSiswa', Auth::user()->idtbSiswa)->first();
      $showmentor=DB::table('tbmentor')
      ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
      ->where('tbmentor.idmentor', $id)->first();
      $getprodi = DB::table('tbdetailmentor')->where('idtbRiwayatTutor', $id)->value('prodi');
        $getexplode = explode(', ',$getprodi);
      return view ('formAjukan', ['showsiswa'=> $showsiswa,'isCompleted' => $showing, 'showmentor' => $showmentor, 'explode'=>$getexplode ]);
      // return $getexplode;
    }

    public function ajukan(Request $request){
      DB::table('scedulebimbel')->insert([
        'durasi' => $request->durasi,
        'startBimbel' => $request->start,
        'endBimbel' => $request->end,
      ]);
      return redirect('/dashboardsiswa');

    }

    
    public function dashboardsiswa(Request $request)
    {
        $provinsi  = DB::table('provinsi')->get();
        $idprovinsi  = DB::table('provinsi')->pluck('id');
        $kabupaten = DB::table('kota_kabupaten')->get();
        $kecamatan = DB::table('kecamatan')->get();
        $kelurahan = DB::table('kelurahan')->get();
        $tahun = Carbon::now()->isoFormat('YY');
        $bulan = Carbon::now()->format('m');
        $noidsiswa = 'S' . $bulan . $tahun;
        $siswa2  = DB::table('tbsiswa')->get();
        if(Tbsiswa::where('idtbSiswa', Auth::user()->idtbSiswa)->value('NoIDSiswa')==NULL){
            
            if(strlen((string)Auth::user()->idtbSiswa)==1){
                Tbsiswa::where('idtbSiswa', Auth::user()->idtbSiswa)->update(['NoIDSiswa' => $noidsiswa.'0000'.Auth::user()->idtbSiswa]);
            }else if(strlen((string)Auth::user()->idtbSiswa)==2){
                Tbsiswa::where('idtbSiswa', Auth::user()->idtbSiswa)->update(['NoIDSiswa' => $noidsiswa.'000'.Auth::user()->idtbSiswa]);
            }
            else if(strlen((string)Auth::user()->idtbSiswa)==3){
                Tbsiswa::where('idtbSiswa', Auth::user()->idtbSiswa)->update(['NoIDSiswa' => $noidsiswa.'00'.Auth::user()->idtbSiswa]);
            }
            else if(strlen((string)Auth::user()->idtbSiswa)==4){
                Tbsiswa::where('idtbSiswa', Auth::user()->idtbSiswa)->update(['NoIDSiswa' => $noidsiswa.'0'.Auth::user()->idtbSiswa]);
            }
            else {
                Tbsiswa::where('idtbSiswa', Auth::user()->idtbSiswa)->update(['NoIDSiswa' => $noidsiswa.Auth::user()->idtbSiswa]);
        }
        }

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
        $getprodi = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->value('prodiSiswa');
        $getexplode = explode(', ',$getprodi);
        if(count($getexplode)==1){
            $getMentor  = DB::table('tbdetailmentor')
            ->join('tbmentor','tbdetailmentor.idmentor','=','tbmentor.idmentor')
            ->where('prodi', 'like', '%'.$getexplode[0].'%')
            ->where('statusTutor', '=', 1)
            ->where('statKomplit', '=', 7)
            ->paginate(5);    
        }elseif(count($getexplode)==2){
            $getMentor  = DB::table('tbdetailmentor')
            ->join('tbmentor','tbdetailmentor.idmentor','=','tbmentor.idmentor')
            ->where('statusTutor', '=', 1)
            ->where('statKomplit', '=', 7)
            ->where(function($q){
                $getprodi = DB::table('tbdetailsiswa')
                ->where('idtbDetailSiswa', Auth::user()->idtbSiswa)
                ->value('prodiSiswa');
                $getexplode = explode(', ',$getprodi);
                $q->where('prodi', 'like', '%'.$getexplode[0].'%')
                ->orWhere('prodi', 'like', '%'.$getexplode[1].'%');})
                ->paginate(5);    
        }elseif(count($getexplode)==3){
            $getMentor  = DB::table('tbdetailmentor')
            ->join('tbmentor','tbdetailmentor.idmentor','=','tbmentor.idmentor')
            ->where('statusTutor', '=', 1)
            ->where('statKomplit', '=', 7)
            ->where(function($q){
                $getprodi = DB::table('tbdetailsiswa')
                ->where('idtbDetailSiswa', Auth::user()->idtbSiswa)
                ->value('prodiSiswa');
                $getexplode = explode(', ',$getprodi);
                $q->where('prodi', 'like', '%'.$getexplode[0].'%')
                ->orWhere('prodi', 'like', '%'.$getexplode[1].'%')
                ->orWhere('prodi', 'like', '%'.$getexplode[2].'%');})
                ->paginate(5);    
        }elseif(count($getexplode)==4){
            $getMentor  = DB::table('tbdetailmentor')
            ->join('tbmentor','tbdetailmentor.idmentor','=','tbmentor.idmentor')
            ->where('statusTutor', '=', 1)
            ->where('statKomplit', '=', 7)
            ->where(function($q){
                $getprodi = DB::table('tbdetailsiswa')
                ->where('idtbDetailSiswa', Auth::user()->idtbSiswa)
                ->value('prodiSiswa');
                $getexplode = explode(', ',$getprodi);
                $q->where('prodi', 'like', '%'.$getexplode[0].'%')
                ->orWhere('prodi', 'like', '%'.$getexplode[1].'%')
                ->orWhere('prodi', 'like', '%'.$getexplode[2].'%')
                ->orWhere('prodi', 'like', '%'.$getexplode[3].'%');})
                ->paginate(5);            
        }elseif(count($getexplode)==5){
            $getMentor  = DB::table('tbdetailmentor')
            ->join('tbmentor','tbdetailmentor.idmentor','=','tbmentor.idmentor')
            ->where('statusTutor', '=', 1)
            ->where('statKomplit', '=', 7)
            ->where(function($q){
                $getprodi = DB::table('tbdetailsiswa')
                ->where('idtbDetailSiswa', Auth::user()->idtbSiswa)
                ->value('prodiSiswa');
                $getexplode = explode(', ',$getprodi);
                $q->where('prodi', 'like', '%'.$getexplode[0].'%')
                ->orWhere('prodi', 'like', '%'.$getexplode[1].'%')
                ->orWhere('prodi', 'like', '%'.$getexplode[2].'%')
                ->orWhere('prodi', 'like', '%'.$getexplode[3].'%')
                ->orWhere('prodi', 'like', '%'.$getexplode[4].'%');})
                ->paginate(5);                        
        }  
        else{

        }

   
        if($request['pendidikan']==1){ //SMA, SMK, D3
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->whereIN('pendidikanTerakhir',[3,4])
            ->paginate(5);
  //=================================================================================ISI 1=====================================================================================
            //BIN, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN, PROVINSI
            if($request->hasAny('bin') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //BIN DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
          
          //MTK, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
          if($request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%Matematika%')
            ->where('provinsi',$request['provinsi'])
            ->where('kota',$request['kabupaten'])
            ->where('kecamatan',$request['kecamatan'])
            ->where('kelurahan',$request['kelurahan'])
            ->whereIN('pendidikanTerakhir',[3,4])
            ->paginate(5);
          }
          //MTK, PROVINSI, KABUPATEN, KECAMATAN,
          if($request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%Matematika%')
            ->where('provinsi',$request['provinsi'])
            ->where('kota',$request['kabupaten'])
            ->where('kecamatan',$request['kecamatan'])
            ->whereIN('pendidikanTerakhir',[3,4])
            ->paginate(5);
          }
          //MTK, PROVINSI, KABUPATEN
          if($request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%Matematika%')
            ->where('provinsi',$request['provinsi'])
            ->where('kota',$request['kabupaten'])
            ->whereIN('pendidikanTerakhir',[3,4])
            ->paginate(5);
          }
          //MTK, PROVINSI
          if($request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
          }
          //MTK DAN SEMUA LOKASI
          if($request->hasAny('mtk') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
          }

         //IPA, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
         if($request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPA%')
          ->where('provinsi',$request['provinsi'])
          ->where('kota',$request['kabupaten'])
          ->where('kecamatan',$request['kecamatan'])
          ->where('kelurahan',$request['kelurahan'])
          ->whereIN('pendidikanTerakhir',[3,4])
          ->paginate(5);
        }
        //IPA, PROVINSI, KABUPATEN, KECAMATAN,
        if($request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPA%')
          ->where('provinsi',$request['provinsi'])
          ->where('kota',$request['kabupaten'])
          ->where('kecamatan',$request['kecamatan'])
          ->whereIN('pendidikanTerakhir',[3,4])
          ->paginate(5);
        }
        //IPA, PROVINSI, KABUPATEN
        if($request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPA%')
          ->where('provinsi',$request['provinsi'])
          ->where('kota',$request['kabupaten'])
          ->whereIN('pendidikanTerakhir',[3,4])
          ->paginate(5);
        }
        //IPA, PROVINSI
        if($request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%IPA%')
            ->where('provinsi',$request['provinsi'])
            ->whereIN('pendidikanTerakhir',[3,4])
            ->paginate(5);
        }
        //IPA DAN SEMUA LOKASI
        if($request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%IPA%')
            ->whereIN('pendidikanTerakhir',[3,4])
            ->paginate(5);
        }

       //IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
       if($request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%IPS%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->where('kecamatan',$request['kecamatan'])
        ->where('kelurahan',$request['kelurahan'])
        ->whereIN('pendidikanTerakhir',[3,4])
        ->paginate(5);
      }
      //IPS, PROVINSI, KABUPATEN, KECAMATAN,
      if($request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%IPS%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->where('kecamatan',$request['kecamatan'])
        ->whereIN('pendidikanTerakhir',[3,4])
        ->paginate(5);
      }
      //IPS, PROVINSI, KABUPATEN
      if($request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%IPS%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->whereIN('pendidikanTerakhir',[3,4])
        ->paginate(5);
      }
      //IPS, PROVINSI
      if($request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPS%')
          ->where('provinsi',$request['provinsi'])
          ->whereIN('pendidikanTerakhir',[3,4])
          ->paginate(5);
      }
      //IPS DAN SEMUA LOKASI
      if($request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPS%')
          ->whereIN('pendidikanTerakhir',[3,4])
          ->paginate(5);
      }

      //BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
      if($request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%Bhs. Inggris%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->where('kecamatan',$request['kecamatan'])
        ->where('kelurahan',$request['kelurahan'])
        ->whereIN('pendidikanTerakhir',[3,4])
        ->paginate(5);
      }
      //BIG, PROVINSI, KABUPATEN, KECAMATAN,
      if($request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%Bhs. Inggris%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->where('kecamatan',$request['kecamatan'])
        ->whereIN('pendidikanTerakhir',[3,4])
        ->paginate(5);
      }
      //BIG, PROVINSI, KABUPATEN
      if($request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%Bhs. Inggris%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->whereIN('pendidikanTerakhir',[3,4])
        ->paginate(5);
      }
      //BIG, PROVINSI
      if($request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%Bhs. Inggris%')
          ->where('provinsi',$request['provinsi'])
          ->whereIN('pendidikanTerakhir',[3,4])
          ->paginate(5);
      }
      //BIG DAN SEMUA LOKASI
      if($request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%Bhs. Inggris%')
          ->whereIN('pendidikanTerakhir',[3,4])
          ->paginate(5);
      }
  //=================================================================================ISI 2=====================================================================================
  //=================================================================================BIN & MTK =====================================================================================

              //BIN & MTK, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //BIN & MTK DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }

               //=================================================================================BIN & IPA =====================================================================================

          //BIN & IPA, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('ipa')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & IPA, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & IPA, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('ipa') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & IPA, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //BIN & IPA DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%IPA%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }

             //=================================================================================BIN & IPS =====================================================================================

          //BIN & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('ips')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & IPS, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & IPS, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('ips') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & IPS, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //BIN & IPS DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%IPS%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }

              //=================================================================================BIN & BIG =====================================================================================

          //BIN & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('big') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & BIG, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //BIN & BIG DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
              
               //=================================================================================MTK & IPA =====================================================================================

          //MTK & IPA, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('mtk') && $request->hasAny('ipa')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //MTK & IPA, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //MTK & IPA, PROVINSI, KABUPATEN
            if($request->hasAny('mtk') && $request->hasAny('ipa') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //MTK & IPA, PROVINSI
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //MTK & IPA DAN SEMUA LOKASI
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }

           //=================================================================================MTK & IPS =====================================================================================

          //MTK & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('mtk') && $request->hasAny('ips')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //MTK & IPS, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //MTK & IPS, PROVINSI, KABUPATEN
            if($request->hasAny('mtk') && $request->hasAny('ips') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //MTK & IPS, PROVINSI
            if($request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //MTK & IPS DAN SEMUA LOKASI
            if($request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPS%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }

                //=================================================================================MTK & BIG =====================================================================================

          //MTK & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('mtk') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //MTK & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //MTK & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('mtk') && $request->hasAny('big') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //MTK & BIG, PROVINSI
            if($request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //MTK & BIG DAN SEMUA LOKASI
            if($request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
                  //=================================================================================IPA & IPS =====================================================================================

          //IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('ipa') && $request->hasAny('ips')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //IPA & IPS, PROVINSI, KABUPATEN
            if($request->hasAny('ipa') && $request->hasAny('ips') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //IPA & IPS, PROVINSI
            if($request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //IPA & IPS DAN SEMUA LOKASI
            if($request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->orWhere('prodi','like','%IPS%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
               //=================================================================================IPA & BIG =====================================================================================

          //IPA & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('ipa') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //IPA & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //IPA & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('ipa') && $request->hasAny('big') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //IPA & BIG, PROVINSI
            if($request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //IPA & BIG DAN SEMUA LOKASI
            if($request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
               //=================================================================================IPS & BIG =====================================================================================

          //IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('ips') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //IPS & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('ips') && $request->hasAny('big') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //IPS & BIG, PROVINSI
            if($request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //IPS & BIG DAN SEMUA LOKASI
            if($request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPS%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
  //=================================================================================ISI 3=====================================================================================
              //=================================================================================BIN & MTK & IPA=====================================================================================

              //BIN & MTK & IPA, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ipa')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPA, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPA, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPA, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //BIN & MTK & IPA, DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
                //=================================================================================BIN & MTK & IPS=====================================================================================

              //BIN & MTK & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ips')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPS, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPS, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPS, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //BIN & MTK & IPS DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPS%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
              //=================================================================================BIN & MTK & BIG=====================================================================================

              //BIN & MTK & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & BIG, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //BIN & MTK & BIG DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
              //=================================================================================MTK & IPA & IPS=====================================================================================

              //MTK & IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('mtk')  && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            // MTK & IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //MTK & IPA & IPS, PROVINSI, KABUPATEN
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            // MTK & IPA & IPS, PROVINSI
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //MTK & IPA & IPS, DAN SEMUA LOKASI
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->orwhere('prodi','like','%IPS%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
                        //=================================================================================IPA & IPS & BIG =====================================================================================

               //IPA & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            // IPA & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //IPA & IPS & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //IPA & IPS & BIG, PROVINSI
            if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //IPA & IPS & BIG, DAN SEMUA LOKASI
            if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->orwhere('prodi','like','%IPS%')
                ->orwhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
  //=================================================================================ISI 4=====================================================================================
               //=================================================================================BIN & MTK & IPA & IPS=====================================================================================

              //BIN & MTK & IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ipa') && $request->hasAny('ips')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPA & IPS, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPA & IPS, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //BIN & MTK & IPA, DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->orWhere('prodi','like','%IPS%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }

            //=================================================================================BIN & MTK & IPA & BIG =====================================================================================
              //BIN & MTK & IPA & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPA & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPA & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPA & BIG, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //BIN & MTK & IPA & BIG, DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
                //=================================================================================BIN & MTK & IPS & BIG=====================================================================================

              //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ips') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPS & BIG, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //BIN & MTK & IPS & BIG DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPS%')
                ->orWhere('prodi','like','%bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
                //=================================================================================BIN & MTK & IPS & BIG =====================================================================================

              //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ips') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPS & BIG, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big')&& $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //BIN & MTK & IPS DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPS%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
              //=================================================================================MTK & IPA & IPS & BIG=====================================================================================

              //MTK & IPA & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('mtk')  && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            // MTK & IPA & IPS & big, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //MTK & IPA & IPS & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            // MTK & IPA & IPS & BIG, PROVINSI
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips')  && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //MTK & IPA & IPS & BIG, DAN SEMUA LOKASI
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->orwhere('prodi','like','%IPS%')
                ->orwhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
  //=================================================================================ISI 5=====================================================================================
              //=================================================================================BIN & MTK & IPA & IPS & BIG=====================================================================================

              //BIN & MTK & IPA & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPA & IPS & big, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPA & IPS & Big, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4])
              ->paginate(5);
            }
            //BIN & MTK & IPA & IPS & BIG, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            //BIN & MTK & IPA & BIG, DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->orWhere('prodi','like','%IPS%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->paginate(5);
            }
            $url=$request->fullUrl();
        }
        elseif($request['pendidikan']==2){ //D3
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->whereIN('pendidikanTerakhir',[5,9])
          ->paginate(5);
          //=================================================================================ISI 1=====================================================================================
            //BIN, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            //BIN, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            //BIN, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            //BIN, PROVINSI
            if($request->hasAny('bin') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
            }
            //BIN DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
            }
          
          //MTK, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
          if($request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%Matematika%')
            ->where('provinsi',$request['provinsi'])
            ->where('kota',$request['kabupaten'])
            ->where('kecamatan',$request['kecamatan'])
            ->where('kelurahan',$request['kelurahan'])
            ->whereIN('pendidikanTerakhir',[5,9])
            ->paginate(5);
          }
          //MTK, PROVINSI, KABUPATEN, KECAMATAN,
          if($request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%Matematika%')
            ->where('provinsi',$request['provinsi'])
            ->where('kota',$request['kabupaten'])
            ->where('kecamatan',$request['kecamatan'])
            ->whereIN('pendidikanTerakhir',[5,9])
            ->paginate(5);
          }
          //MTK, PROVINSI, KABUPATEN
          if($request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%Matematika%')
            ->where('provinsi',$request['provinsi'])
            ->where('kota',$request['kabupaten'])
            ->whereIN('pendidikanTerakhir',[5,9])
            ->paginate(5);
          }
          //MTK, PROVINSI
          if($request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
          }
          //MTK DAN SEMUA LOKASI
          if($request->hasAny('mtk') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
          }

         //IPA, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
         if($request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPA%')
          ->where('provinsi',$request['provinsi'])
          ->where('kota',$request['kabupaten'])
          ->where('kecamatan',$request['kecamatan'])
          ->where('kelurahan',$request['kelurahan'])
          ->whereIN('pendidikanTerakhir',[5,9])
          ->paginate(5);
        }
        //IPA, PROVINSI, KABUPATEN, KECAMATAN,
        if($request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPA%')
          ->where('provinsi',$request['provinsi'])
          ->where('kota',$request['kabupaten'])
          ->where('kecamatan',$request['kecamatan'])
          ->whereIN('pendidikanTerakhir',[5,9])
          ->paginate(5);
        }
        //IPA, PROVINSI, KABUPATEN
        if($request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPA%')
          ->where('provinsi',$request['provinsi'])
          ->where('kota',$request['kabupaten'])
          ->whereIN('pendidikanTerakhir',[5,9])
          ->paginate(5);
        }
        //IPA, PROVINSI
        if($request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%IPA%')
            ->where('provinsi',$request['provinsi'])
            ->whereIN('pendidikanTerakhir',[5,9])
            ->paginate(5);
        }
        //IPA DAN SEMUA LOKASI
        if($request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%IPA%')
            ->whereIN('pendidikanTerakhir',[5,9])
            ->paginate(5);
        }

       //IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
       if($request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%IPS%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->where('kecamatan',$request['kecamatan'])
        ->where('kelurahan',$request['kelurahan'])
        ->whereIN('pendidikanTerakhir',[5,9])
        ->paginate(5);
      }
      //IPS, PROVINSI, KABUPATEN, KECAMATAN,
      if($request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%IPS%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->where('kecamatan',$request['kecamatan'])
        ->whereIN('pendidikanTerakhir',[5,9])
        ->paginate(5);
      }
      //IPS, PROVINSI, KABUPATEN
      if($request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%IPS%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->whereIN('pendidikanTerakhir',[5,9])
        ->paginate(5);
      }
      //IPS, PROVINSI
      if($request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPS%')
          ->where('provinsi',$request['provinsi'])
          ->whereIN('pendidikanTerakhir',[5,9])
          ->paginate(5);
      }
      //IPS DAN SEMUA LOKASI
      if($request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPS%')
          ->whereIN('pendidikanTerakhir',[5,9])
          ->paginate(5);
      }

      //BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
      if($request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%Bhs. Inggris%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->where('kecamatan',$request['kecamatan'])
        ->where('kelurahan',$request['kelurahan'])
        ->whereIN('pendidikanTerakhir',[5,9])
        ->paginate(5);
      }
      //BIG, PROVINSI, KABUPATEN, KECAMATAN,
      if($request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%Bhs. Inggris%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->where('kecamatan',$request['kecamatan'])
        ->whereIN('pendidikanTerakhir',[5,9])
        ->paginate(5);
      }
      //BIG, PROVINSI, KABUPATEN
      if($request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%Bhs. Inggris%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->whereIN('pendidikanTerakhir',[5,9])
        ->paginate(5);
      }
      //BIG, PROVINSI
      if($request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%Bhs. Inggris%')
          ->where('provinsi',$request['provinsi'])
          ->whereIN('pendidikanTerakhir',[5,9])
          ->paginate(5);
      }
      //BIG DAN SEMUA LOKASI
      if($request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%Bhs. Inggris%')
          ->whereIN('pendidikanTerakhir',[5,9])
          ->paginate(5);
      }
      //=================================================================================ISI 2=====================================================================================
  //=================================================================================BIN & MTK =====================================================================================

              //BIN & MTK, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('bin') && $request->hasAny('mtk')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & MTK, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & MTK, PROVINSI, KABUPATEN
              if($request->hasAny('bin') && $request->hasAny('mtk') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & MTK, PROVINSI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
              //BIN & MTK DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%Matematika%')
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
  
                 //=================================================================================BIN & IPA =====================================================================================
  
            //BIN & IPA, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('bin') && $request->hasAny('ipa')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & IPA, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('bin') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & IPA, PROVINSI, KABUPATEN
              if($request->hasAny('bin') && $request->hasAny('ipa') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & IPA, PROVINSI
              if($request->hasAny('bin') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPA%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
              //BIN & IPA DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%IPA%')
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
  
               //=================================================================================BIN & IPS =====================================================================================
  
            //BIN & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('bin') && $request->hasAny('ips')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & IPS, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('bin') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & IPS, PROVINSI, KABUPATEN
              if($request->hasAny('bin') && $request->hasAny('ips') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & IPS, PROVINSI
              if($request->hasAny('bin') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPS%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
              //BIN & IPS DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%IPS%')
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
  
                //=================================================================================BIN & BIG =====================================================================================
  
            //BIN & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('bin') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & BIG, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('bin') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & BIG, PROVINSI, KABUPATEN
              if($request->hasAny('bin') && $request->hasAny('big') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & BIG, PROVINSI
              if($request->hasAny('bin') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
              //BIN & BIG DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
                
                 //=================================================================================MTK & IPA =====================================================================================
  
            //MTK & IPA, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('mtk') && $request->hasAny('ipa')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //MTK & IPA, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //MTK & IPA, PROVINSI, KABUPATEN
              if($request->hasAny('mtk') && $request->hasAny('ipa') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //MTK & IPA, PROVINSI
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPA%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
              //MTK & IPA DAN SEMUA LOKASI
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%IPA%')
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
  
             //=================================================================================MTK & IPS =====================================================================================
  
            //MTK & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('mtk') && $request->hasAny('ips')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //MTK & IPS, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //MTK & IPS, PROVINSI, KABUPATEN
              if($request->hasAny('mtk') && $request->hasAny('ips') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //MTK & IPS, PROVINSI
              if($request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPS%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
              //MTK & IPS DAN SEMUA LOKASI
              if($request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%IPS%')
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
  
                  //=================================================================================MTK & BIG =====================================================================================
  
            //MTK & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('mtk') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //MTK & BIG, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //MTK & BIG, PROVINSI, KABUPATEN
              if($request->hasAny('mtk') && $request->hasAny('big') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //MTK & BIG, PROVINSI
              if($request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
              //MTK & BIG DAN SEMUA LOKASI
              if($request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
                    //=================================================================================IPA & IPS =====================================================================================
  
            //IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('ipa') && $request->hasAny('ips')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //IPA & IPS, PROVINSI, KABUPATEN
              if($request->hasAny('ipa') && $request->hasAny('ips') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //IPA & IPS, PROVINSI
              if($request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%IPA%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPS%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
              //IPA & IPS DAN SEMUA LOKASI
              if($request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%IPA%')
                  ->orWhere('prodi','like','%IPS%')
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
                 //=================================================================================IPA & BIG =====================================================================================
  
            //IPA & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('ipa') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //IPA & BIG, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //IPA & BIG, PROVINSI, KABUPATEN
              if($request->hasAny('ipa') && $request->hasAny('big') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //IPA & BIG, PROVINSI
              if($request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%IPA%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
              //IPA & BIG DAN SEMUA LOKASI
              if($request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%IPA%')
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
                 //=================================================================================IPS & BIG =====================================================================================
  
            //IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('ips') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //IPS & BIG, PROVINSI, KABUPATEN
              if($request->hasAny('ips') && $request->hasAny('big') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //IPS & BIG, PROVINSI
              if($request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%IPS%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
              //IPS & BIG DAN SEMUA LOKASI
              if($request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%IPS%')
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
               //=================================================================================ISI 3=====================================================================================
              //=================================================================================BIN & MTK & IPA=====================================================================================

              //BIN & MTK & IPA, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ipa')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            //BIN & MTK & IPA, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            //BIN & MTK & IPA, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            //BIN & MTK & IPA, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
            }
            //BIN & MTK & IPA, DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
            }
                //=================================================================================BIN & MTK & IPS=====================================================================================

              //BIN & MTK & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ips')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            //BIN & MTK & IPS, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            //BIN & MTK & IPS, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            //BIN & MTK & IPS, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
            }
            //BIN & MTK & IPS DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPS%')
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
            }
              //=================================================================================BIN & MTK & BIG=====================================================================================

              //BIN & MTK & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            //BIN & MTK & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            //BIN & MTK & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            //BIN & MTK & BIG, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
            }
            //BIN & MTK & BIG DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
            }
              //=================================================================================MTK & IPA & IPS=====================================================================================

              //MTK & IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('mtk')  && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            // MTK & IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            //MTK & IPA & IPS, PROVINSI, KABUPATEN
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            // MTK & IPA & IPS, PROVINSI
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
            }
            //MTK & IPA & IPS, DAN SEMUA LOKASI
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->orwhere('prodi','like','%IPS%')
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
            }
                        //=================================================================================IPA & IPS & BIG =====================================================================================

               //IPA & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            // IPA & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            //IPA & IPS & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            //IPA & IPS & BIG, PROVINSI
            if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
            }
            //IPA & IPS & BIG, DAN SEMUA LOKASI
            if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->orwhere('prodi','like','%IPS%')
                ->orwhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
            }
            //=================================================================================ISI 4=====================================================================================
               //=================================================================================BIN & MTK & IPA & IPS=====================================================================================

              //BIN & MTK & IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ipa') && $request->hasAny('ips')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan']) 
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & MTK & IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & MTK & IPA & IPS, PROVINSI, KABUPATEN
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & MTK & IPA & IPS, PROVINSI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPA%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPS%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
              //BIN & MTK & IPA, DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%IPA%')
                  ->orWhere('prodi','like','%IPS%')
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
  
              //=================================================================================BIN & MTK & IPA & BIG =====================================================================================
                //BIN & MTK & IPA & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan']) 
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & MTK & IPA & BIG, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & MTK & IPA & BIG, PROVINSI, KABUPATEN
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & MTK & IPA & BIG, PROVINSI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPA%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
              //BIN & MTK & IPA & BIG, DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%IPA%')
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
                  //=================================================================================BIN & MTK & IPS & BIG=====================================================================================
  
                //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ips') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan']) 
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & MTK & IPS & BIG, PROVINSI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPS%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
              //BIN & MTK & IPS & BIG DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%IPS%')
                  ->orWhere('prodi','like','%bhs. Inggris%')
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
                  //=================================================================================BIN & MTK & IPS & BIG =====================================================================================
  
                //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ips') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan']) 
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //BIN & MTK & IPS & BIG, PROVINSI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big')&& $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPS%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
              //BIN & MTK & IPS DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%IPS%')
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
                //=================================================================================MTK & IPA & IPS & BIG=====================================================================================
  
                //MTK & IPA & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('mtk')  && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan']) 
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              // MTK & IPA & IPS & big, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              //MTK & IPA & IPS & BIG, PROVINSI, KABUPATEN
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
              }
              // MTK & IPA & IPS & BIG, PROVINSI
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips')  && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPA%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPS%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
              //MTK & IPA & IPS & BIG, DAN SEMUA LOKASI
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%IPA%')
                  ->orwhere('prodi','like','%IPS%')
                  ->orwhere('prodi','like','%Bhs. Inggris%')
                  ->whereIN('pendidikanTerakhir',[5,9])
                  ->paginate(5);
              }
              //=================================================================================ISI 5=====================================================================================
              //=================================================================================BIN & MTK & IPA & IPS & BIG=====================================================================================

              //BIN & MTK & IPA & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            //BIN & MTK & IPA & IPS & big, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            //BIN & MTK & IPA & IPS & Big, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[5,9])
              ->paginate(5);
            }
            //BIN & MTK & IPA & IPS & BIG, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
            }
            //BIN & MTK & IPA & BIG, DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->orWhere('prodi','like','%IPS%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[5,9])
                ->paginate(5);
            }
            $url=$request->fullUrl();
        }
        elseif($request['pendidikan']==3){ //S1, S2, S3
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->whereIN('pendidikanTerakhir',[6,7,8])
          ->paginate(5);
           //=================================================================================ISI 1=====================================================================================
                    //=================================================================================BIN=====================================================================================
           
           //BIN, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN, PROVINSI
            if($request->hasAny('bin') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
            //BIN DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
                    //=================================================================================MTK=====================================================================================
          
          //MTK, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
          if($request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%Matematika%')
            ->where('provinsi',$request['provinsi'])
            ->where('kota',$request['kabupaten'])
            ->where('kecamatan',$request['kecamatan'])
            ->where('kelurahan',$request['kelurahan'])
            ->whereIN('pendidikanTerakhir',[6,7,8])
            ->paginate(5);
          }
          //MTK, PROVINSI, KABUPATEN, KECAMATAN,
          if($request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%Matematika%')
            ->where('provinsi',$request['provinsi'])
            ->where('kota',$request['kabupaten'])
            ->where('kecamatan',$request['kecamatan'])
            ->whereIN('pendidikanTerakhir',[6,7,8])
            ->paginate(5);
          }
          //MTK, PROVINSI, KABUPATEN
          if($request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%Matematika%')
            ->where('provinsi',$request['provinsi'])
            ->where('kota',$request['kabupaten'])
            ->whereIN('pendidikanTerakhir',[6,7,8])
            ->paginate(5);
          }
          //MTK, PROVINSI
          if($request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
          }
          //MTK DAN SEMUA LOKASI
          if($request->hasAny('mtk') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
          }
                    //=================================================================================IPA=====================================================================================

         //IPA, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
         if($request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPA%')
          ->where('provinsi',$request['provinsi'])
          ->where('kota',$request['kabupaten'])
          ->where('kecamatan',$request['kecamatan'])
          ->where('kelurahan',$request['kelurahan'])
          ->whereIN('pendidikanTerakhir',[6,7,8])
          ->paginate(5);
        }
        //IPA, PROVINSI, KABUPATEN, KECAMATAN,
        if($request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPA%')
          ->where('provinsi',$request['provinsi'])
          ->where('kota',$request['kabupaten'])
          ->where('kecamatan',$request['kecamatan'])
          ->whereIN('pendidikanTerakhir',[6,7,8])
          ->paginate(5);
        }
        //IPA, PROVINSI, KABUPATEN
        if($request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPA%')
          ->where('provinsi',$request['provinsi'])
          ->where('kota',$request['kabupaten'])
          ->whereIN('pendidikanTerakhir',[6,7,8])
          ->paginate(5);
        }
        //IPA, PROVINSI
        if($request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%IPA%')
            ->where('provinsi',$request['provinsi'])
            ->whereIN('pendidikanTerakhir',[6,7,8])
            ->paginate(5);
        }
        //IPA DAN SEMUA LOKASI
        if($request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%IPA%')
            ->whereIN('pendidikanTerakhir',[6,7,8])
            ->paginate(5);
        }
                    //=================================================================================ips=====================================================================================

       //IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
       if($request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%IPS%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->where('kecamatan',$request['kecamatan'])
        ->where('kelurahan',$request['kelurahan'])
        ->whereIN('pendidikanTerakhir',[6,7,8])
        ->paginate(5);
      }
      //IPS, PROVINSI, KABUPATEN, KECAMATAN,
      if($request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%IPS%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->where('kecamatan',$request['kecamatan'])
        ->whereIN('pendidikanTerakhir',[6,7,8])
        ->paginate(5);
      }
      //IPS, PROVINSI, KABUPATEN
      if($request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%IPS%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->whereIN('pendidikanTerakhir',[6,7,8])
        ->paginate(5);
      }
      //IPS, PROVINSI
      if($request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPS%')
          ->where('provinsi',$request['provinsi'])
          ->whereIN('pendidikanTerakhir',[6,7,8])
          ->paginate(5);
      }
      //IPS DAN SEMUA LOKASI
      if($request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPS%')
          ->whereIN('pendidikanTerakhir',[6,7,8])
          ->paginate(5);
      }
                    //=================================================================================BIG=====================================================================================
    
      //BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
      if($request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%Bhs. Inggris%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->where('kecamatan',$request['kecamatan'])
        ->where('kelurahan',$request['kelurahan'])
        ->whereIN('pendidikanTerakhir',[6,7,8])
        ->paginate(5);
      }
      //BIG, PROVINSI, KABUPATEN, KECAMATAN,
      if($request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%Bhs. Inggris%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->where('kecamatan',$request['kecamatan'])
        ->whereIN('pendidikanTerakhir',[6,7,8])
        ->paginate(5);
      }
      //BIG, PROVINSI, KABUPATEN
      if($request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%Bhs. Inggris%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->whereIN('pendidikanTerakhir',[6,7,8])
        ->paginate(5);
      }
      //BIG, PROVINSI
      if($request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%Bhs. Inggris%')
          ->where('provinsi',$request['provinsi'])
          ->whereIN('pendidikanTerakhir',[6,7,8])
          ->paginate(5);
      }
      //BIG DAN SEMUA LOKASI
      if($request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%Bhs. Inggris%')
          ->whereIN('pendidikanTerakhir',[6,7,8])
          ->paginate(5);
      }
      //=================================================================================ISI 2=====================================================================================
  //=================================================================================BIN & MTK =====================================================================================

              //BIN & MTK, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & MTK, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & MTK, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & MTK, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
            //BIN & MTK DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }

               //=================================================================================BIN & IPA =====================================================================================

          //BIN & IPA, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('ipa')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & IPA, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & IPA, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('ipa') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & IPA, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
            //BIN & IPA DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%IPA%')
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }

             //=================================================================================BIN & IPS =====================================================================================

          //BIN & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('ips')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & IPS, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & IPS, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('ips') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & IPS, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
            //BIN & IPS DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%IPS%')
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }

              //=================================================================================BIN & BIG =====================================================================================

          //BIN & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('big') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & BIG, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
            //BIN & BIG DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
              
               //=================================================================================MTK & IPA =====================================================================================

          //MTK & IPA, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('mtk') && $request->hasAny('ipa')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //MTK & IPA, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //MTK & IPA, PROVINSI, KABUPATEN
            if($request->hasAny('mtk') && $request->hasAny('ipa') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //MTK & IPA, PROVINSI
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
            //MTK & IPA DAN SEMUA LOKASI
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }

           //=================================================================================MTK & IPS =====================================================================================

          //MTK & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('mtk') && $request->hasAny('ips')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //MTK & IPS, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //MTK & IPS, PROVINSI, KABUPATEN
            if($request->hasAny('mtk') && $request->hasAny('ips') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //MTK & IPS, PROVINSI
            if($request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
            //MTK & IPS DAN SEMUA LOKASI
            if($request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPS%')
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }

                //=================================================================================MTK & BIG =====================================================================================

          //MTK & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('mtk') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //MTK & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //MTK & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('mtk') && $request->hasAny('big') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //MTK & BIG, PROVINSI
            if($request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
            //MTK & BIG DAN SEMUA LOKASI
            if($request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
                  //=================================================================================IPA & IPS =====================================================================================

          //IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('ipa') && $request->hasAny('ips')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //IPA & IPS, PROVINSI, KABUPATEN
            if($request->hasAny('ipa') && $request->hasAny('ips') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //IPA & IPS, PROVINSI
            if($request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
            //IPA & IPS DAN SEMUA LOKASI
            if($request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->orWhere('prodi','like','%IPS%')
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
               //=================================================================================IPA & BIG =====================================================================================

          //IPA & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('ipa') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //IPA & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //IPA & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('ipa') && $request->hasAny('big') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //IPA & BIG, PROVINSI
            if($request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
            //IPA & BIG DAN SEMUA LOKASI
            if($request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
               //=================================================================================IPS & BIG =====================================================================================

          //IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('ips') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //IPS & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('ips') && $request->hasAny('big') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //IPS & BIG, PROVINSI
            if($request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
            //IPS & BIG DAN SEMUA LOKASI
            if($request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPS%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
            //=================================================================================ISI 3=====================================================================================
              //=================================================================================BIN & MTK & IPA=====================================================================================

              //BIN & MTK & IPA, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ipa')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan']) 
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
              }
              //BIN & MTK & IPA, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
              }
              //BIN & MTK & IPA, PROVINSI, KABUPATEN
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
              }
              //BIN & MTK & IPA, PROVINSI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPA%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[6,7,8])
                  ->paginate(5);
              }
              //BIN & MTK & IPA, DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%IPA%')
                  ->whereIN('pendidikanTerakhir',[6,7,8])
                  ->paginate(5);
              }
                  //=================================================================================BIN & MTK & IPS=====================================================================================
  
                //BIN & MTK & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ips')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan']) 
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
              }
              //BIN & MTK & IPS, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
              }
              //BIN & MTK & IPS, PROVINSI, KABUPATEN
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
              }
              //BIN & MTK & IPS, PROVINSI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPS%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[6,7,8])
                  ->paginate(5);
              }
              //BIN & MTK & IPS DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%IPS%')
                  ->whereIN('pendidikanTerakhir',[6,7,8])
                  ->paginate(5);
              }
                //=================================================================================BIN & MTK & BIG=====================================================================================
  
                //BIN & MTK & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan']) 
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
              }
              //BIN & MTK & BIG, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
              }
              //BIN & MTK & BIG, PROVINSI, KABUPATEN
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
              }
              //BIN & MTK & BIG, PROVINSI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[6,7,8])
                  ->paginate(5);
              }
              //BIN & MTK & BIG DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->whereIN('pendidikanTerakhir',[6,7,8])
                  ->paginate(5);
              }
                //=================================================================================MTK & IPA & IPS=====================================================================================
  
                //MTK & IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('mtk')  && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan']) 
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
              }
              // MTK & IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
              }
              //MTK & IPA & IPS, PROVINSI, KABUPATEN
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
              }
              // MTK & IPA & IPS, PROVINSI
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPA%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPS%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[6,7,8])
                  ->paginate(5);
              }
              //MTK & IPA & IPS, DAN SEMUA LOKASI
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%IPA%')
                  ->orwhere('prodi','like','%IPS%')
                  ->whereIN('pendidikanTerakhir',[6,7,8])
                  ->paginate(5);
              }
                          //=================================================================================IPA & IPS & BIG =====================================================================================
  
                 //IPA & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
              }
              // IPA & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
              }
              //IPA & IPS & BIG, PROVINSI, KABUPATEN
              if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
              }
              //IPA & IPS & BIG, PROVINSI
              if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%IPA%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPS%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[6,7,8])
                  ->paginate(5);
              }
              //IPA & IPS & BIG, DAN SEMUA LOKASI
              if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%IPA%')
                  ->orwhere('prodi','like','%IPS%')
                  ->orwhere('prodi','like','%Bhs. Inggris%')
                  ->whereIN('pendidikanTerakhir',[6,7,8])
                  ->paginate(5);
              }
              //=================================================================================ISI 4=====================================================================================
               //=================================================================================BIN & MTK & IPA & IPS=====================================================================================

              //BIN & MTK & IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ipa') && $request->hasAny('ips')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & MTK & IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & MTK & IPA & IPS, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & MTK & IPA & IPS, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
            //BIN & MTK & IPA, DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->orWhere('prodi','like','%IPS%')
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }

            //=================================================================================BIN & MTK & IPA & BIG =====================================================================================
              //BIN & MTK & IPA & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & MTK & IPA & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & MTK & IPA & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & MTK & IPA & BIG, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
            //BIN & MTK & IPA & BIG, DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
                //=================================================================================BIN & MTK & IPS & BIG=====================================================================================

              //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ips') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & MTK & IPS & BIG, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
            //BIN & MTK & IPS & BIG DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPS%')
                ->orWhere('prodi','like','%bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
                //=================================================================================BIN & MTK & IPS & BIG =====================================================================================

              //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ips') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //BIN & MTK & IPS & BIG, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big')&& $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
            //BIN & MTK & IPS DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPS%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
              //=================================================================================MTK & IPA & IPS & BIG=====================================================================================

              //MTK & IPA & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('mtk')  && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            // MTK & IPA & IPS & big, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            //MTK & IPA & IPS & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->paginate(5);
            }
            // MTK & IPA & IPS & BIG, PROVINSI
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips')  && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
            //MTK & IPA & IPS & BIG, DAN SEMUA LOKASI
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->orwhere('prodi','like','%IPS%')
                ->orwhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
            }
            //=================================================================================ISI 5=====================================================================================
              //=================================================================================BIN & MTK & IPA & IPS & BIG=====================================================================================

              //BIN & MTK & IPA & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan']) 
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
              }
              //BIN & MTK & IPA & IPS & big, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
              }
              //BIN & MTK & IPA & IPS & Big, PROVINSI, KABUPATEN
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->paginate(5);
              }
              //BIN & MTK & IPA & IPS & BIG, PROVINSI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPA%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPS%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->where('provinsi',$request['provinsi'])
                  ->whereIN('pendidikanTerakhir',[6,7,8])
                  ->paginate(5);
              }
              //BIN & MTK & IPA & BIG, DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%IPA%')
                  ->orWhere('prodi','like','%IPS%')
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->whereIN('pendidikanTerakhir',[6,7,8])
                  ->paginate(5);
              }
             $url= $request->fullUrl();
        }
        elseif($request['pendidikan']==4)
        { // SEMUA JENJANG
          $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->paginate(5);
             //=================================================================================ISI 1=====================================================================================
                    //=================================================================================BIN=====================================================================================
           
           //BIN, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
           if($request->hasAny('bin') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%Bhs. Indonesia%')
            ->where('provinsi',$request['provinsi'])
            ->where('kota',$request['kabupaten'])
            ->where('kecamatan',$request['kecamatan'])
            ->where('kelurahan',$request['kelurahan'])
            ->paginate(5);
          }
          //BIN, PROVINSI, KABUPATEN, KECAMATAN,
          if($request->hasAny('bin') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%Bhs. Indonesia%')
            ->where('provinsi',$request['provinsi'])
            ->where('kota',$request['kabupaten'])
            ->where('kecamatan',$request['kecamatan'])
            ->paginate(5);
          }
          //BIN, PROVINSI, KABUPATEN
          if($request->hasAny('bin') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%Bhs. Indonesia%')
            ->where('provinsi',$request['provinsi'])
            ->where('kota',$request['kabupaten'])
            ->paginate(5);
          }
          //BIN, PROVINSI
          if($request->hasAny('bin') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->paginate(5);
          }
          //BIN DAN SEMUA LOKASI
          if($request->hasAny('bin') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->paginate(5);
          }
                  //=================================================================================MTK=====================================================================================
        
        //MTK, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
        if($request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%Matematika%')
          ->where('provinsi',$request['provinsi'])
          ->where('kota',$request['kabupaten'])
          ->where('kecamatan',$request['kecamatan'])
          ->where('kelurahan',$request['kelurahan'])
          ->paginate(5);
        }
        //MTK, PROVINSI, KABUPATEN, KECAMATAN,
        if($request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%Matematika%')
          ->where('provinsi',$request['provinsi'])
          ->where('kota',$request['kabupaten'])
          ->where('kecamatan',$request['kecamatan'])
          ->paginate(5);
        }
        //MTK, PROVINSI, KABUPATEN
        if($request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%Matematika%')
          ->where('provinsi',$request['provinsi'])
          ->where('kota',$request['kabupaten'])
          ->paginate(5);
        }
        //MTK, PROVINSI
        if($request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%Matematika%')
            ->where('provinsi',$request['provinsi'])
            ->paginate(5);
        }
        //MTK DAN SEMUA LOKASI
        if($request->hasAny('mtk') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%Matematika%')
            ->paginate(5);
        }
                  //=================================================================================IPA=====================================================================================

       //IPA, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
       if($request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%IPA%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->where('kecamatan',$request['kecamatan'])
        ->where('kelurahan',$request['kelurahan'])
        ->paginate(5);
      }
      //IPA, PROVINSI, KABUPATEN, KECAMATAN,
      if($request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%IPA%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->where('kecamatan',$request['kecamatan'])
        ->paginate(5);
      }
      //IPA, PROVINSI, KABUPATEN
      if($request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%IPA%')
        ->where('provinsi',$request['provinsi'])
        ->where('kota',$request['kabupaten'])
        ->paginate(5);
      }
      //IPA, PROVINSI
      if($request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPA%')
          ->where('provinsi',$request['provinsi'])
          ->paginate(5);
      }
      //IPA DAN SEMUA LOKASI
      if($request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPA%')
          ->paginate(5);
      }
                  //=================================================================================ips=====================================================================================

     //IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
     if($request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
      $grup=DB::table('tbmentor')
      ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
      ->where('statKomplit',7)
      ->where('statusTutor',1)
      ->where('prodi','like','%IPS%')
      ->where('provinsi',$request['provinsi'])
      ->where('kota',$request['kabupaten'])
      ->where('kecamatan',$request['kecamatan'])
      ->where('kelurahan',$request['kelurahan'])
      ->paginate(5);
    }
    //IPS, PROVINSI, KABUPATEN, KECAMATAN,
    if($request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
      $grup=DB::table('tbmentor')
      ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
      ->where('statKomplit',7)
      ->where('statusTutor',1)
      ->where('prodi','like','%IPS%')
      ->where('provinsi',$request['provinsi'])
      ->where('kota',$request['kabupaten'])
      ->where('kecamatan',$request['kecamatan'])
      ->paginate(5);
    }
    //IPS, PROVINSI, KABUPATEN
    if($request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
      $grup=DB::table('tbmentor')
      ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
      ->where('statKomplit',7)
      ->where('statusTutor',1)
      ->where('prodi','like','%IPS%')
      ->where('provinsi',$request['provinsi'])
      ->where('kota',$request['kabupaten'])
      ->paginate(5);
    }
    //IPS, PROVINSI
    if($request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%IPS%')
        ->where('provinsi',$request['provinsi'])
        ->paginate(5);
    }
    //IPS DAN SEMUA LOKASI
    if($request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%IPS%')
        ->paginate(5);
    }
                  //=================================================================================BIG=====================================================================================
  
    //BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
    if($request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
      $grup=DB::table('tbmentor')
      ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
      ->where('statKomplit',7)
      ->where('statusTutor',1)
      ->where('prodi','like','%Bhs. Inggris%')
      ->where('provinsi',$request['provinsi'])
      ->where('kota',$request['kabupaten'])
      ->where('kecamatan',$request['kecamatan'])
      ->where('kelurahan',$request['kelurahan'])
      ->paginate(5);
    }
    //BIG, PROVINSI, KABUPATEN, KECAMATAN,
    if($request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
      $grup=DB::table('tbmentor')
      ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
      ->where('statKomplit',7)
      ->where('statusTutor',1)
      ->where('prodi','like','%Bhs. Inggris%')
      ->where('provinsi',$request['provinsi'])
      ->where('kota',$request['kabupaten'])
      ->where('kecamatan',$request['kecamatan'])
      ->paginate(5);
    }
    //BIG, PROVINSI, KABUPATEN
    if($request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
      $grup=DB::table('tbmentor')
      ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
      ->where('statKomplit',7)
      ->where('statusTutor',1)
      ->where('prodi','like','%Bhs. Inggris%')
      ->where('provinsi',$request['provinsi'])
      ->where('kota',$request['kabupaten'])
      ->paginate(5);
    }
    //BIG, PROVINSI
    if($request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%Bhs. Inggris%')
        ->where('provinsi',$request['provinsi'])
        ->paginate(5);
    }
    //BIG DAN SEMUA LOKASI
    if($request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%Bhs. Inggris%')
        ->paginate(5);
    }
      //=================================================================================ISI 2=====================================================================================
  //=================================================================================BIN & MTK =====================================================================================

              //BIN & MTK, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('bin') && $request->hasAny('mtk')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->paginate(5);
              }
              //BIN & MTK, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->paginate(5);
              }
              //BIN & MTK, PROVINSI, KABUPATEN
              if($request->hasAny('bin') && $request->hasAny('mtk') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->paginate(5);
              }
              //BIN & MTK, PROVINSI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->paginate(5);
              }
              //BIN & MTK DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%Matematika%')
                  ->paginate(5);
              }
  
                 //=================================================================================BIN & IPA =====================================================================================
  
            //BIN & IPA, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('bin') && $request->hasAny('ipa')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->paginate(5);
              }
              //BIN & IPA, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('bin') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->paginate(5);
              }
              //BIN & IPA, PROVINSI, KABUPATEN
              if($request->hasAny('bin') && $request->hasAny('ipa') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->paginate(5);
              }
              //BIN & IPA, PROVINSI
              if($request->hasAny('bin') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPA%')
                  ->where('provinsi',$request['provinsi'])
                  ->paginate(5);
              }
              //BIN & IPA DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%IPA%')
                  ->paginate(5);
              }
  
               //=================================================================================BIN & IPS =====================================================================================
  
            //BIN & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('bin') && $request->hasAny('ips')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->paginate(5);
              }
              //BIN & IPS, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('bin') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->paginate(5);
              }
              //BIN & IPS, PROVINSI, KABUPATEN
              if($request->hasAny('bin') && $request->hasAny('ips') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->paginate(5);
              }
              //BIN & IPS, PROVINSI
              if($request->hasAny('bin') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPS%')
                  ->where('provinsi',$request['provinsi'])
                  ->paginate(5);
              }
              //BIN & IPS DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%IPS%')
                  ->paginate(5);
              }
  
                //=================================================================================BIN & BIG =====================================================================================
  
            //BIN & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('bin') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->paginate(5);
              }
              //BIN & BIG, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('bin') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->paginate(5);
              }
              //BIN & BIG, PROVINSI, KABUPATEN
              if($request->hasAny('bin') && $request->hasAny('big') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->paginate(5);
              }
              //BIN & BIG, PROVINSI
              if($request->hasAny('bin') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->where('provinsi',$request['provinsi'])
                  ->paginate(5);
              }
              //BIN & BIG DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->paginate(5);
              }
                
                 //=================================================================================MTK & IPA =====================================================================================
  
            //MTK & IPA, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('mtk') && $request->hasAny('ipa')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->paginate(5);
              }
              //MTK & IPA, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->paginate(5);
              }
              //MTK & IPA, PROVINSI, KABUPATEN
              if($request->hasAny('mtk') && $request->hasAny('ipa') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->paginate(5);
              }
              //MTK & IPA, PROVINSI
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPA%')
                  ->where('provinsi',$request['provinsi'])
                  ->paginate(5);
              }
              //MTK & IPA DAN SEMUA LOKASI
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%IPA%')
                  ->paginate(5);
              }
  
             //=================================================================================MTK & IPS =====================================================================================
  
            //MTK & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('mtk') && $request->hasAny('ips')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->paginate(5);
              }
              //MTK & IPS, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->paginate(5);
              }
              //MTK & IPS, PROVINSI, KABUPATEN
              if($request->hasAny('mtk') && $request->hasAny('ips') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->paginate(5);
              }
              //MTK & IPS, PROVINSI
              if($request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPS%')
                  ->where('provinsi',$request['provinsi'])
                  ->paginate(5);
              }
              //MTK & IPS DAN SEMUA LOKASI
              if($request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%IPS%')
                  ->paginate(5);
              }
  
                  //=================================================================================MTK & BIG =====================================================================================
  
            //MTK & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('mtk') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->paginate(5);
              }
              //MTK & BIG, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->paginate(5);
              }
              //MTK & BIG, PROVINSI, KABUPATEN
              if($request->hasAny('mtk') && $request->hasAny('big') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->paginate(5);
              }
              //MTK & BIG, PROVINSI
              if($request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->where('provinsi',$request['provinsi'])
                  ->paginate(5);
              }
              //MTK & BIG DAN SEMUA LOKASI
              if($request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->paginate(5);
              }
                    //=================================================================================IPA & IPS =====================================================================================
  
            //IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('ipa') && $request->hasAny('ips')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->paginate(5);
              }
              //IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->paginate(5);
              }
              //IPA & IPS, PROVINSI, KABUPATEN
              if($request->hasAny('ipa') && $request->hasAny('ips') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->paginate(5);
              }
              //IPA & IPS, PROVINSI
              if($request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%IPA%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPS%')
                  ->where('provinsi',$request['provinsi'])
                  ->paginate(5);
              }
              //IPA & IPS DAN SEMUA LOKASI
              if($request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%IPA%')
                  ->orWhere('prodi','like','%IPS%')
                  ->paginate(5);
              }
                 //=================================================================================IPA & BIG =====================================================================================
  
            //IPA & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('ipa') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->paginate(5);
              }
              //IPA & BIG, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->paginate(5);
              }
              //IPA & BIG, PROVINSI, KABUPATEN
              if($request->hasAny('ipa') && $request->hasAny('big') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->paginate(5);
              }
              //IPA & BIG, PROVINSI
              if($request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%IPA%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->where('provinsi',$request['provinsi'])
                  ->paginate(5);
              }
              //IPA & BIG DAN SEMUA LOKASI
              if($request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%IPA%')
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->paginate(5);
              }
                 //=================================================================================IPS & BIG =====================================================================================
  
            //IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('ips') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->paginate(5);
              }
              //IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->paginate(5);
              }
              //IPS & BIG, PROVINSI, KABUPATEN
              if($request->hasAny('ips') && $request->hasAny('big') &&  $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->paginate(5);
              }
              //IPS & BIG, PROVINSI
              if($request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%IPS%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->where('provinsi',$request['provinsi'])
                  ->paginate(5);
              }
              //IPS & BIG DAN SEMUA LOKASI
              if($request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%IPS%')
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->paginate(5);
              }
              //=================================================================================ISI 3=====================================================================================
              //=================================================================================BIN & MTK & IPA=====================================================================================

              //BIN & MTK & IPA, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ipa')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan']) 
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->paginate(5);
              }
              //BIN & MTK & IPA, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->paginate(5);
              }
              //BIN & MTK & IPA, PROVINSI, KABUPATEN
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->paginate(5);
              }
              //BIN & MTK & IPA, PROVINSI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPA%')
                  ->where('provinsi',$request['provinsi'])
                  ->paginate(5);
              }
              //BIN & MTK & IPA, DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%IPA%')
                  ->paginate(5);
              }
                  //=================================================================================BIN & MTK & IPS=====================================================================================
  
                //BIN & MTK & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ips')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan']) 
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->paginate(5);
              }
              //BIN & MTK & IPS, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->paginate(5);
              }
              //BIN & MTK & IPS, PROVINSI, KABUPATEN
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->paginate(5);
              }
              //BIN & MTK & IPS, PROVINSI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPS%')
                  ->where('provinsi',$request['provinsi'])
                  ->paginate(5);
              }
              //BIN & MTK & IPS DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%IPS%')
                  ->paginate(5);
              }
                //=================================================================================BIN & MTK & BIG=====================================================================================
  
                //BIN & MTK & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan']) 
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->paginate(5);
              }
              //BIN & MTK & BIG, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->paginate(5);
              }
              //BIN & MTK & BIG, PROVINSI, KABUPATEN
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->paginate(5);
              }
              //BIN & MTK & BIG, PROVINSI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->where('provinsi',$request['provinsi'])
                  ->paginate(5);
              }
              //BIN & MTK & BIG DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->paginate(5);
              }
                //=================================================================================MTK & IPA & IPS=====================================================================================
  
                //MTK & IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('mtk')  && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan']) 
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->paginate(5);
              }
              // MTK & IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->paginate(5);
              }
              //MTK & IPA & IPS, PROVINSI, KABUPATEN
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->paginate(5);
              }
              // MTK & IPA & IPS, PROVINSI
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPA%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPS%')
                  ->where('provinsi',$request['provinsi'])
                  ->paginate(5);
              }
              //MTK & IPA & IPS, DAN SEMUA LOKASI
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%IPA%')
                  ->orwhere('prodi','like','%IPS%')
                  ->paginate(5);
              }
                          //=================================================================================IPA & IPS & BIG =====================================================================================
  
                 //IPA & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->paginate(5);
              }
              // IPA & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->paginate(5);
              }
              //IPA & IPS & BIG, PROVINSI, KABUPATEN
              if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->paginate(5);
              }
              //IPA & IPS & BIG, PROVINSI
              if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%IPA%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPS%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->where('provinsi',$request['provinsi'])
                  ->paginate(5);
              }
              //IPA & IPS & BIG, DAN SEMUA LOKASI
              if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%IPA%')
                  ->orwhere('prodi','like','%IPS%')
                  ->orwhere('prodi','like','%Bhs. Inggris%')
                  ->paginate(5);
              }
              //=================================================================================ISI 4=====================================================================================
               //=================================================================================BIN & MTK & IPA & IPS=====================================================================================

              //BIN & MTK & IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ipa') && $request->hasAny('ips')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->paginate(5);
            }
            //BIN & MTK & IPA & IPS, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->paginate(5);
            }
            //BIN & MTK & IPA & IPS, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->paginate(5);
            }
            //BIN & MTK & IPA & IPS, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->paginate(5);
            }
            //BIN & MTK & IPA, DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->orWhere('prodi','like','%IPS%')
                ->paginate(5);
            }

            //=================================================================================BIN & MTK & IPA & BIG =====================================================================================
              //BIN & MTK & IPA & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->paginate(5);
            }
            //BIN & MTK & IPA & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->paginate(5);
            }
            //BIN & MTK & IPA & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->paginate(5);
            }
            //BIN & MTK & IPA & BIG, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->paginate(5);
            }
            //BIN & MTK & IPA & BIG, DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->paginate(5);
            }
                //=================================================================================BIN & MTK & IPS & BIG=====================================================================================

              //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ips') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->paginate(5);
            }
            //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->paginate(5);
            }
            //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->paginate(5);
            }
            //BIN & MTK & IPS & BIG, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->paginate(5);
            }
            //BIN & MTK & IPS & BIG DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPS%')
                ->orWhere('prodi','like','%bhs. Inggris%')
                ->paginate(5);
            }
                //=================================================================================BIN & MTK & IPS & BIG =====================================================================================

              //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ips') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->paginate(5);
            }
            //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->paginate(5);
            }
            //BIN & MTK & IPS & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->paginate(5);
            }
            //BIN & MTK & IPS & BIG, PROVINSI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big')&& $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->paginate(5);
            }
            //BIN & MTK & IPS DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPS%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->paginate(5);
            }
              //=================================================================================MTK & IPA & IPS & BIG=====================================================================================

              //MTK & IPA & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
            if($request->hasAny('mtk')  && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan']) 
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->where('kelurahan',$request['kelurahan'])
              ->paginate(5);
            }
            // MTK & IPA & IPS & big, PROVINSI, KABUPATEN, KECAMATAN,
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->where('kecamatan',$request['kecamatan'])
              ->paginate(5);
            }
            //MTK & IPA & IPS & BIG, PROVINSI, KABUPATEN
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPA%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%IPS%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->orWhere('prodi','like','%Bhs. Inggris%')
              ->where('provinsi',$request['provinsi'])
              ->where('kota',$request['kabupaten'])
              ->paginate(5);
            }
            // MTK & IPA & IPS & BIG, PROVINSI
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips')  && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->paginate(5);
            }
            //MTK & IPA & IPS & BIG, DAN SEMUA LOKASI
            if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->orwhere('prodi','like','%IPS%')
                ->orwhere('prodi','like','%Bhs. Inggris%')
                ->paginate(5);
            }
            //=================================================================================ISI 5=====================================================================================
              //=================================================================================BIN & MTK & IPA & IPS & BIG=====================================================================================

              //BIN & MTK & IPA & IPS & BIG, PROVINSI, KABUPATEN, KECAMATAN, KELURAHAN
              if($request->hasAny('bin') && $request->hasAny('mtk')  && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big')  && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']!==NULL ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan']) 
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->where('kelurahan',$request['kelurahan'])
                ->paginate(5);
              }
              //BIN & MTK & IPA & IPS & big, PROVINSI, KABUPATEN, KECAMATAN,
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']!==NULL && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->where('kecamatan',$request['kecamatan'])
                ->paginate(5);
              }
              //BIN & MTK & IPA & IPS & Big, PROVINSI, KABUPATEN
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL && $request['kecamatan']==0 && $request['kelurahan']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Matematika%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPA%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%IPS%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->where('provinsi',$request['provinsi'])
                ->where('kota',$request['kabupaten'])
                ->paginate(5);
              }
              //BIN & MTK & IPA & IPS & BIG, PROVINSI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Matematika%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPA%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%IPS%')
                  ->where('provinsi',$request['provinsi'])
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->where('provinsi',$request['provinsi'])
                  ->paginate(5);
              }
              //BIN & MTK & IPA & BIG, DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%IPA%')
                  ->orWhere('prodi','like','%IPS%')
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->paginate(5);
              } 
      $url=$request->fullUrl();

      }
      else{
        $url=NULL;
        $grup=NULL;
      
      }
      // $url= Request::url();
      // $url=$request->fullUrl();
      // $url = $request->path();
    
        return view('dashboardsiswa', ['isCompleted' => $showing,'idp'=>$idprovinsi,'grup'=> $grup, 'url'=>$url, 'mentor'=>$getMentor,'s'=>$siswa2, 'p' => $provinsi, 'b' => $kabupaten, 'c' => $kecamatan, 'd' => $kelurahan]);
        
        // return $getexplode;
    }
    public function profilesiswa()
    {
        // $showing = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->first();
        
        
       
        $show  = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('namaWali')->toArray();
        $show1 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('pendidikanSiswa')->toArray();
        $show2 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('jenjang')->toArray();       
        $show3 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('prodiSiswa')->toArray(); 
        $show4 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->pluck('tingkatPendidikan')->toArray();
        $show5 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->value('jenjang');
        $show6 = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->value('tingkatpendidikan'); 
        $show7 = array_merge($show, $show1, $show2, $show3, $show4,  );
        $counting = count(array_filter($show7, "is_null"));

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
        $provinsi  = DB::table('provinsi')->get();
        $kabupaten = DB::table('kota_kabupaten')->get();
        $kecamatan = DB::table('kecamatan')->get();
        $kelurahan = DB::table('kelurahan')->get();
        $jenjang = DB::table('tbjenjangpendidikan')->get();
        $tingkatPendidikan = DB::table('tbtingkatpendidikan')->get();
        $prodisiswa = DB::table('mastermatpel')->get();
        $prodi=DB::table('tbdetailsiswa')->where('idtbSiswa', Auth::user()->idtbSiswa)->value('prodiSiswa');
        $prodi2=implode(' ',[$prodi]);
        return view('profilesiswa', ['getprodi'=>$prodi2, 'isCompleted' => $showing , 'p' => $provinsi, 'b' => $kabupaten, 'c' => $kecamatan, 'd' => $kelurahan, 'j' => $jenjang, 'tp' => $tingkatPendidikan, 'jenjang' => $show5, 'tingkatpendidikan' => $show6,  'prodi'=>$prodisiswa]);
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
        return view('myprofilesiswa' , ['ProfilSiswa' => $showing,'s'=>$siswa] , ['isCompleted' => $showing,'s'=>$siswa]);
    }
    public function jadwalsiswa(){
        $siswa = DB::table('tbsiswa')->where('idtbSiswa', Auth::user()->idtbSiswa)->first();
        $showing = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->first();
        return view('jadwalsiswa' , ['ProfilSiswa' => $showing,'s'=>$siswa] , ['isCompleted' => $showing,'s'=>$siswa]);
    }
    public function calendarsiswa(){
        $siswa = DB::table('tbsiswa')->where('idtbSiswa', Auth::user()->idtbSiswa)->first();
        $showing = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->first();
        return view('calendarsiswa' , ['ProfilSiswa' => $showing,'s'=>$siswa] , ['isCompleted' => $showing,'s'=>$siswa]);
    }
    public function multimediasiswa(){
        $siswa = DB::table('tbsiswa')->where('idtbSiswa', Auth::user()->idtbSiswa)->first();
        $showing = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->first();
        return view('multimediasiswa' , ['ProfilSiswa' => $showing,'s'=>$siswa] , ['isCompleted' => $showing,'s'=>$siswa]);
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
        if($request->hasAny('prodi')){
            $prodi=$request['prodi'];
            $prodi2=implode(', ',$prodi);
            $Tbdetailsiswa->prodiSiswa = $prodi2; 
        }else{
            $prodi=$request['prodi'];
            $Tbdetailsiswa->prodiSiswa = $prodi; 
        }
        // $Tbdetailsiswa->prodiSiswa=$request['prodi'];
        $foto = $request->file('fotoProfile');
        // $tujuan_upload = 'data_fileSiswa';
        if ($request->hasFile('fotoProfile')) {
            $show = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->value('fotoProfile');
            $nama_foto = time() . "_" . $foto->getClientOriginalName();
            $tujuan_upload2 = public_path('/data_fileSiswa2');
            $thumb_img = Image::make($foto->getRealPath())->resize(100, 100);
            $thumb_img->save($tujuan_upload2.'/'.$nama_foto,80);
            File::delete($tujuan_upload2 . '/' . $show);
            $tujuan_upload2 = public_path('/data_fileSiswa') ;
            
            $foto->move($tujuan_upload2, $nama_foto);
            File::delete($tujuan_upload2 . '/' . $show);
            $Tbdetailsiswa->fotoProfile = $nama_foto;
        } else { }
        $Tbdetailsiswa->save();
        return redirect('/myprofilesiswa')->with('message', 'IT WORKS!');
      
      
    }
}