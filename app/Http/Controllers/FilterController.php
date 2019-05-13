<?Php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Routing\Controller;
use DB;
use File;
use App\Tbsiswa;
use App\Tbdetailsiswa;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class FilterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:siswa');
    }

    public function Filter(Request $request)
    {
        if($request['pendidikan']==1){ //SMA, SMK, D3
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->whereIN('pendidikanTerakhir',[3,4])
            ->get();
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
              ->get('prodi');
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
              ->get('prodi');
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
              ->get('prodi');
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
                ->get("prodi");
            }
            //BIN DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->whereIN('pendidikanTerakhir',[3,4])
                ->get("prodi");
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
            ->get('prodi');
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
            ->get();
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
            ->get();
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
              ->get("prodi");
          }
          //MTK DAN SEMUA LOKASI
          if($request->hasAny('mtk') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->whereIN('pendidikanTerakhir',[3,4])
              ->get("prodi");
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
          ->get('prodi');
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
          ->get('prodi');
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
          ->get();
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
            ->get("prodi");
        }
        //IPA DAN SEMUA LOKASI
        if($request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%IPA%')
            ->whereIN('pendidikanTerakhir',[3,4])
            ->get("prodi");
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
        ->get();
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
        ->get();
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
        ->get();
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
          ->get("prodi");
      }
      //IPS DAN SEMUA LOKASI
      if($request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPS%')
          ->whereIN('pendidikanTerakhir',[3,4])
          ->get("prodi");
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
        ->get('prodi');
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
        ->get('prodi');
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
        ->get('prodi');
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
          ->get("prodi");
      }
      //BIG DAN SEMUA LOKASI
      if($request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%Bhs. Inggris%')
          ->whereIN('pendidikanTerakhir',[3,4])
          ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get();
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get();
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get();
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get();
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get();
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get();
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get();
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get();
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
            }

        }
        elseif($request['pendidikan']==2){ //D3
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->whereIN('pendidikanTerakhir',[5,9])
          ->get();
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
              ->get('prodi');
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
              ->get('prodi');
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
              ->get('prodi');
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
                ->get("prodi");
            }
            //BIN DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->whereIN('pendidikanTerakhir',[5,9])
                ->get("prodi");
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
            ->get('prodi');
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
            ->get();
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
            ->get();
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
              ->get("prodi");
          }
          //MTK DAN SEMUA LOKASI
          if($request->hasAny('mtk') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->whereIN('pendidikanTerakhir',[5,9])
              ->get("prodi");
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
          ->get('prodi');
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
          ->get('prodi');
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
          ->get();
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
            ->get("prodi");
        }
        //IPA DAN SEMUA LOKASI
        if($request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%IPA%')
            ->whereIN('pendidikanTerakhir',[5,9])
            ->get("prodi");
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
        ->get();
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
        ->get();
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
        ->get();
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
          ->get("prodi");
      }
      //IPS DAN SEMUA LOKASI
      if($request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPS%')
          ->whereIN('pendidikanTerakhir',[5,9])
          ->get("prodi");
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
        ->get('prodi');
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
        ->get('prodi');
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
        ->get('prodi');
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
          ->get("prodi");
      }
      //BIG DAN SEMUA LOKASI
      if($request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%Bhs. Inggris%')
          ->whereIN('pendidikanTerakhir',[5,9])
          ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get();
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get();
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get();
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get();
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get();
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get();
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get();
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get();
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
            }

        }
        elseif($request['pendidikan']==3){ //S1, S2, S3
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->whereIN('pendidikanTerakhir',[6,7,8])
          ->get();
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
            }
            //BIN DAN SEMUA LOKASI
            if($request->hasAny('bin') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->whereIN('pendidikanTerakhir',[6,7,8])
                ->get();
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
            ->get('prodi');
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
            ->get();
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
            ->get();
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
              ->get("prodi");
          }
          //MTK DAN SEMUA LOKASI
          if($request->hasAny('mtk') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->whereIN('pendidikanTerakhir',[6,7,8])
              ->get("prodi");
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
          ->get('prodi');
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
          ->get('prodi');
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
          ->get();
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
            ->get("prodi");
        }
        //IPA DAN SEMUA LOKASI
        if($request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%IPA%')
            ->whereIN('pendidikanTerakhir',[6,7,8])
            ->get("prodi");
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
        ->get();
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
        ->get();
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
        ->get();
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
          ->get("prodi");
      }
      //IPS DAN SEMUA LOKASI
      if($request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPS%')
          ->whereIN('pendidikanTerakhir',[6,7,8])
          ->get("prodi");
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
        ->get('prodi');
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
        ->get('prodi');
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
        ->get('prodi');
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
          ->get("prodi");
      }
      //BIG DAN SEMUA LOKASI
      if($request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%Bhs. Inggris%')
          ->whereIN('pendidikanTerakhir',[6,7,8])
          ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get();
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get();
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get();
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get();
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get();
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get();
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get();
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get();
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get("prodi");
              }
        }
        else
        { // SEMUA JENJANG
          $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->get();
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
            ->get();
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
            ->get();
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
            ->get();
          }
          //BIN, PROVINSI
          if($request->hasAny('bin') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->get();
          }
          //BIN DAN SEMUA LOKASI
          if($request->hasAny('bin') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->get();
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
          ->get('prodi');
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
          ->get();
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
          ->get();
        }
        //MTK, PROVINSI
        if($request->hasAny('mtk') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%Matematika%')
            ->where('provinsi',$request['provinsi'])
            ->get("prodi");
        }
        //MTK DAN SEMUA LOKASI
        if($request->hasAny('mtk') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%Matematika%')
            ->get("prodi");
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
        ->get('prodi');
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
        ->get('prodi');
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
        ->get();
      }
      //IPA, PROVINSI
      if($request->hasAny('ipa') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPA%')
          ->where('provinsi',$request['provinsi'])
          ->get("prodi");
      }
      //IPA DAN SEMUA LOKASI
      if($request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPA%')
          ->get("prodi");
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
      ->get();
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
      ->get();
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
      ->get();
    }
    //IPS, PROVINSI
    if($request->hasAny('ips') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%IPS%')
        ->where('provinsi',$request['provinsi'])
        ->get("prodi");
    }
    //IPS DAN SEMUA LOKASI
    if($request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%IPS%')
        ->get("prodi");
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
      ->get('prodi');
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
      ->get('prodi');
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
      ->get('prodi');
    }
    //BIG, PROVINSI
    if($request->hasAny('big') && $request['provinsi']!==NULL && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%Bhs. Inggris%')
        ->where('provinsi',$request['provinsi'])
        ->get("prodi");
    }
    //BIG DAN SEMUA LOKASI
    if($request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%Bhs. Inggris%')
        ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
              }
              //BIN & MTK DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%Matematika%')
                  ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
              }
              //BIN & IPA DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%IPA%')
                  ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
              }
              //BIN & IPS DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%IPS%')
                  ->get();
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
              }
              //BIN & BIG DAN SEMUA LOKASI
              if($request->hasAny('bin') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Bhs. Indonesia%')
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->get();
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
              }
              //MTK & IPA DAN SEMUA LOKASI
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%IPA%')
                  ->get();
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
              }
              //MTK & IPS DAN SEMUA LOKASI
              if($request->hasAny('mtk') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%IPS%')
                  ->get();
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
              }
              //MTK & BIG DAN SEMUA LOKASI
              if($request->hasAny('mtk') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%Matematika%')
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->get();
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
              }
              //IPA & IPS DAN SEMUA LOKASI
              if($request->hasAny('ipa') && $request->hasAny('ips') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%IPA%')
                  ->orWhere('prodi','like','%IPS%')
                  ->get();
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
              }
              //IPA & BIG DAN SEMUA LOKASI
              if($request->hasAny('ipa') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%IPA%')
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->get();
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
              }
              //IPS & BIG DAN SEMUA LOKASI
              if($request->hasAny('ips') && $request->hasAny('big') && $request['provinsi']==0 && $request['kabupaten']==0  && $request['kecamatan']==0 && $request['kelurahan']==0){
                  $grup=DB::table('tbmentor')
                  ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                  ->where('statKomplit',7)
                  ->where('statusTutor',1)
                  ->where('prodi','like','%IPS%')
                  ->orWhere('prodi','like','%Bhs. Inggris%')
                  ->get();
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
              ->get();
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
              ->get();
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
              ->get();
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
                ->get();
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
                ->get("prodi");
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
                ->get();
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
                ->get();
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
                ->get();
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
                  ->get();
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
                  ->get("prodi");
              }         
      }  
        return count($grup)." ".json_encode( $grup);

        // return $grup;
    }      
}