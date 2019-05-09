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
            ->whereIN('pendidikanTerakhir',[3,4,5])
            ->get("prodi");
  //=================================================================================ISI 1=====================================================================================
            if($request->hasAny('bin') ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
            }
            if($request->hasAny('bin') && $request['provinsi']!==NULL && $request['kabupaten']!==NULL ){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Bhs. Indonesia%')
              ->where('provinsi',$request['provinsi'])
              ->where('provinsi',$request['kabupaten'])
              ->whereIN('pendidikanTerakhir',[3,4,5])
              ->get('prodi');
            }
            if($request->hasAny('bin') && $request['provinsi']!==NULL){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->where('provinsi',$request['provinsi'])
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
            }
            if($request->hasAny('bin') && $request['provinsi']==0 ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
            }
            if($request->hasAny('mtk')){
              $grup=DB::table('tbmentor')
              ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
              ->where('statKomplit',7)
              ->where('statusTutor',1)
              ->where('prodi','like','%Matematika%')
              ->whereIN('pendidikanTerakhir',[3,4,5])
              ->get("prodi");
          }
          if($request->hasAny('ipa')){
            $grup=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->where('prodi','like','%IPA%')
            ->whereIN('pendidikanTerakhir',[3,4,5])
            ->get("prodi");
        }
        if($request->hasAny('ips')){
          $grup=DB::table('tbmentor')
          ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
          ->where('statKomplit',7)
          ->where('statusTutor',1)
          ->where('prodi','like','%IPS%')
          ->whereIN('pendidikanTerakhir',[3,4,5])
          ->get("prodi");
      }
      if($request->hasAny('big')){
        $grup=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
        ->where('statKomplit',7)
        ->where('statusTutor',1)
        ->where('prodi','like','%Bhs. Inggris%')
        ->whereIN('pendidikanTerakhir',[3,4,5])
        ->get("prodi");
    }
  //=================================================================================ISI 2=====================================================================================

            if($request->hasAny('bin') && $request->hasAny('mtk')){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }
              if($request->hasAny('bin') && $request->hasAny('ipa')){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%IPA%')
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }
              if($request->hasAny('bin') && $request->hasAny('ips')){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%IPS%')
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }
              if($request->hasAny('bin') && $request->hasAny('big')){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }
              if($request->hasAny('mtk') && $request->hasAny('ipa')){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }
              if($request->hasAny('mtk') && $request->hasAny('ips')){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPS%')
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }
              if($request->hasAny('mtk') && $request->hasAny('big')){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }
              if($request->hasAny('ipa') && $request->hasAny('ips')){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->orWhere('prodi','like','%IPS%')
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }
              if($request->hasAny('ipa') && $request->hasAny('big')){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }
              if($request->hasAny('ips') && $request->hasAny('big')){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPS%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }
  //=================================================================================ISI 3=====================================================================================

              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa')){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips')){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPS%')
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('big')){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips')){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->orWhere('prodi','like','%IPS%')
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }
              if($request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big')){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPS%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }
              if($request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big')){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%IPA%')
                ->orWhere('prodi','like','%IPS%')
                ->orWhere('prodi','like','%Bhs. Inggris%')
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }
  //=================================================================================ISI 4=====================================================================================

              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->orWhere('prodi','like','%IPS%')                
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('big') ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->orWhere('prodi','like','%Bhs. Inggris%')                
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }
              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ips') && $request->hasAny('big') ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPS%')
                ->orWhere('prodi','like','%Bhs. Inggris%')                
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }
              if($request->hasAny('bin') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Bhs. Indonesia%')
                ->orWhere('prodi','like','%IPA%')
                ->orWhere('prodi','like','%IPS%')
                ->orWhere('prodi','like','%Bhs. Inggris%')                
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }
              if($request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big') ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)
                ->where('prodi','like','%Matematika%')
                ->orWhere('prodi','like','%IPA%')
                ->orWhere('prodi','like','%IPS%')
                ->orWhere('prodi','like','%Bhs. Inggris%')                
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }


  //=================================================================================ISI 5=====================================================================================

              if($request->hasAny('bin') && $request->hasAny('mtk') && $request->hasAny('ipa') && $request->hasAny('ips') && $request->hasAny('big')  ){
                $grup=DB::table('tbmentor')
                ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
                ->where('statKomplit',7)
                ->where('statusTutor',1)              
                ->whereIN('pendidikanTerakhir',[3,4,5])
                ->get("prodi");
              }






        }
        return count($grup)." ".json_encode( $grup);

        // return $grup;

    }
        
}