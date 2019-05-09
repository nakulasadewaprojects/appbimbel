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
    public function dashboardsiswa()
    {
        $provinsi  = DB::table('provinsi')->get();
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
            ->get();
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
                ->get();
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
                ->get();
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
                ->get();            
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
                ->get();                        
        }  
        else{

        }
        
        return view('dashboardsiswa', ['isCompleted' => $showing,'mentor'=>$getMentor,'s'=>$siswa2, 'p' => $provinsi, 'b' => $kabupaten, 'c' => $kecamatan, 'd' => $kelurahan]);
        
        // return $getexplode;
    }
    public function getFilterPendidikan( Request $request){
        if($request['pendidikan']==1){ //SMA, SMK, D3
            $mentor=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->whereIN('pendidikanTerakhir',[3,4,5]);
            $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
            ->get();
            // if($request->hasAny('bhsIndonesia'))
            // { //bhsIndonesia
            //     $mentor->where('prodi','like','%Indonesia%');
            //     $grup= $mentor->orderBy('pendidikanTerakhir','DESC')
            //     ->get('prodi');
            //     // $grup=['a'];
            //     if($request->hasAny('mtk')){ //bhsIndonesia, mtk berurutan
            //         $mentor->orWhere('prodi','like','%Matematika%');
            //         $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
            //         ->get('prodi');

            //         // $grup=["b"];
            //         // if($request->hasAny('ipa')){
            //         //     $mentor->orWhere('prodi','like','%IPA%');
            //         //     $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
            //         //     ->get('prodi');
            //         //     // $grup=["c"];
            //         //     if($request->hasAny('ips')){
            //         //         $mentor->orWhere('prodi','like','%IPS%');
            //         //         // $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
            //         //         // ->get('prodi');
            //         //         $grup=["d"];
            //         //         if($request->hasAny('bhsInggris')){
            //         //             $mentor->orWhere('prodi','like','%Bhs. Inggris%');
            //         //             $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
            //         //             ->get('prodi');
            //         //             $grup=["e"];

            //         //       }
            //         //     }
                       
            //         // }
            //     }
            //     elseif($request->hasAny('ipa')){
            //         $mentor->orWhere('prodi','like','%IPA%');
            //         $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
            //         ->get('prodi');
            //         // $grup=["f"];
            //         // if($request->hasAny('ips')){
            //         //     $mentor->orWhere('prodi','like','%IPS%');
            //         //     $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
            //         //     ->get('prodi');
            //             // $grup=["d"];
            //         //     if($request->hasAny('bhsInggris')){
            //         //         $mentor->orWhere('prodi','like','%Bhs. Inggris%');
            //         //         $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
            //         //         ->get('prodi');
            //         //         // $grup=["e"];
            //         //   }
            //         // }  
            //     }
            //     elseif($request->hasAny('ips')){
            //         $mentor->orWhere('prodi','like','%IPS%');
            //         $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
            //         ->get('prodi');
            //         // $grup=["d"];
            //         // if($request->hasAny('bhsInggris')){
            //         //     $mentor->orWhere('prodi','like','%Bhs. Inggris%');
            //         //     $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
            //         //     ->get('prodi');
            //         //     // $grup=["e"];
            //     //   }
            //     }
            //     else{
            //         $mentor->orWhere('prodi','like','%Bhs. Inggris%');
            //         $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
            //         ->get('prodi');
            //         // $grup=["e"];
            //   }
                
            // }
             if($request->hasAny('mtk')){
            $mentor->where('prodi','like','%Matematika%');
              $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
              ->get('prodi');
            // $grup=['a'];
            if($request->hasAny('ipa')){
                $mentor->orWhere('prodi','like','%IPA%');
                $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    ->get('prodi');
                if($request->hasAny('ips')){
                    $mentor->orWhere('prodi','like','%IPS%');
                    $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    ->get('prodi'); 
                    // if($request->hasAny('bhsInggris')){
                    //     $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                    //     $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    //     ->get('prodi');
                    //     // $grup=['bbb'];
                    // }
                }  
            }
            if($request->hasAny('ips')){
                $mentor->orWhere('prodi','like','%IPS%');
                $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                ->get('prodi');
                // $grup=['bbb']; 
                // if($request->hasAny('bhsInggris')){
                //     $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                //     $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                //     ->get('prodi');
                //     // $grup=['bbb'];
                // }
            }
            // if($request->hasAny('bhsInggris')){
            //     $mentor->orWhere('prodi','like','%Bhs. Inggris%');
            //     $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
            //     ->get('prodi');
                // $grup=['bbb'];
            // }
        }
            // if($request->hasAny('ipa')){
            //     $mentor->where('prodi','like','%IPA%');
            //       $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
            //       ->get('prodi');
            //     // $grup=['a'];
            //     if($request->hasAny('ips')){
            //         $mentor->orWhere('prodi','like','%IPS%');
            //           $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
            //           ->get('prodi');
            //         // $grup=['b'];
            //         // if($request->hasAny('bhsInggris')){
            //         //     $mentor->orWhere('prodi','like','%Bhs. Inggris%');
            //         //     $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
            //         //     ->get('prodi');
            //         //     // $grup=['bbb'];
            //         // }  
            //     }
            //     // if($request->hasAny('bhsInggris')){
            //     //     $mentor->orWhere('prodi','like','%Bhs. Inggris%');
            //     //     $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
            //     //     ->get('prodi');
            //     //     // $grup=['bbb'];
            //     // }  
            // }
            if($request->hasAny('ips')){
                $mentor->where('prodi','like','%IPS%');
                  $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                  ->get('prodi');
                // $grup=['a'];
                if($request->hasAny('bhsInggris')){
                    $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                    $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    ->get('prodi');
                    // $grup=['bbb'];
                }  

            }
            if($request->hasAny('bhsInggris')){
                $mentor->where('prodi','like','%Bhs. Inggris%');
                $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                ->get('prodi');
                // $grup=['bbb'];
            } 
        } elseif($request['pendidikan']==2){ //S1, S2, S3
            $mentor=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1)
            ->whereIN('pendidikanTerakhir',[6,7,8]);
            $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
            ->get();
            // $grup=['c'];
            if($request->hasAny('bhsIndonesia')){
                $mentor->where('prodi','like','%Indonesia%');
                $grup= $mentor->orderBy('pendidikanTerakhir','DESC')
                ->get('prodi');
                // $grup=['a'];
                if($request->hasAny('mtk')){
                    $mentor->orWhere('prodi','like','%Matematika%');
                    $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    ->get('prodi');
                    // $grup=["b"];
                    // if($request->hasAny('ipa')){
                    //     $mentor->orWhere('prodi','like','%IPA%');
                    //     $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    //     ->get('prodi');
                    //     // $grup=["c"];
                    //     if($request->hasAny('ips')){
                    //         $mentor->orWhere('prodi','like','%IPS%');
                    //         // $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    //         // ->get('prodi');
                    //         $grup=["d"];
                    //         if($request->hasAny('bhsInggris')){
                    //             $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                    //             $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    //             ->get('prodi');
                    //             $grup=["e"];

                    //       }
                    //     }
                       
                    // }
                }
                if($request->hasAny('ipa')){
                    $mentor->orWhere('prodi','like','%IPA%');
                    $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    ->get('prodi');
                    // $grup=["f"];
                    if($request->hasAny('ips')){
                        $mentor->orWhere('prodi','like','%IPS%');
                        $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                        ->get('prodi');
                        // $grup=["d"];
                        if($request->hasAny('bhsInggris')){
                            $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                            $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                            ->get('prodi');
                            // $grup=["e"];
                      }
                    }  
                }
                if($request->hasAny('ips')){
                    $mentor->orWhere('prodi','like','%IPS%');
                    $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    ->get('prodi');
                    // $grup=["d"];
                    if($request->hasAny('bhsInggris')){
                        $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                        $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                        ->get('prodi');
                        // $grup=["e"];
                  }
                }
                if($request->hasAny('bhsInggris')){
                    $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                    $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    ->get('prodi');
                    // $grup=["e"];
              }
                
            }
            if($request->hasAny('mtk')){
                $mentor->where('prodi','like','%Matematika%');
                  $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                  ->get('prodi');
                // $grup=['a'];
                if($request->hasAny('ipa')){
                    $mentor->orWhere('prodi','like','%IPA%');
                    $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                        ->get('prodi');
                    if($request->hasAny('ips')){
                        $mentor->orWhere('prodi','like','%IPS%');
                        $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                        ->get('prodi'); 
                        if($request->hasAny('bhsInggris')){
                            $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                            $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                            ->get('prodi');
                            // $grup=['bbb'];
                        }
                    }  
                }
                if($request->hasAny('ips')){
                    $mentor->orWhere('prodi','like','%IPS%');
                    $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    ->get('prodi');
                    // $grup=['bbb']; 
                    if($request->hasAny('bhsInggris')){
                        $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                        $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                        ->get('prodi');
                        // $grup=['bbb'];
                    }
                }
                if($request->hasAny('bhsInggris')){
                    $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                    $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    ->get('prodi');
                    // $grup=['bbb'];
                }
            }
            if($request->hasAny('ipa')){
                $mentor->where('prodi','like','%IPA%');
                  $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                  ->get('prodi');
                // $grup=['a'];
                if($request->hasAny('ips')){
                    $mentor->orWhere('prodi','like','%IPS%');
                      $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                      ->get('prodi');
                    // $grup=['b'];
                    if($request->hasAny('bhsInggris')){
                        $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                        $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                        ->get('prodi');
                        // $grup=['bbb'];
                    }  
                }
                if($request->hasAny('bhsInggris')){
                    $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                    $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    ->get('prodi');
                    // $grup=['bbb'];
                }  
            }
            if($request->hasAny('ips')){
                $mentor->where('prodi','like','%IPS%');
                  $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                  ->get('prodi');
                // $grup=['a'];
                if($request->hasAny('bhsInggris')){
                    $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                    $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    ->get('prodi');
                    // $grup=['bbb'];
                }  

}

        }
        else
        { // SEMUA JENJANG
            $mentor=DB::table('tbmentor')
            ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')
            ->where('statKomplit',7)
            ->where('statusTutor',1);
            $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
            ->get();
            // $grup=["aho"];
            if($request->hasAny('bhsIndonesia')){
              $mentor->where('prodi','like','%Bhs. Indonesia%');
              $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
              ->get('prodi');
                if($request->hasAny('mtk')){
                    $mentor->orWhere('prodi','like','%Matematika%');
                    $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    ->get('prodi');
                    // $grup=["taho"];
                    if($request->hasAny('ipa')){
                        $mentor->orWhere('prodi','like','%IPA%');
                        $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                        ->get('prodi');
                        $grup=["taho"];
                        if($request->hasAny('ips')){
                            $mentor->orWhere('prodi','like','%IPS%');
                            $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                            ->get('prodi');
                            if($request->hasAny('bhsInggris')){
                                $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                                $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                                ->get('prodi');
                          }
                      }
                  }
                 
              }
              if($request->hasAny('ipa')){
                $mentor->orWhere('prodi','like','%IPA%');
                $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                ->get('prodi');
                if($request->hasAny('ips')){
                    $mentor->orWhere('prodi','like','%IPS%');
                    $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    ->get('prodi');
                    if($request->hasAny('bhsInggris')){
                        $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                        $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                        ->get('prodi');
                  }
                }
                if($request->hasAny('bhsInggris')){
                    $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                    $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    ->get('prodi');
              }
            }
                if($request->hasAny('ips')){
                    $mentor->orWhere('prodi','like','%IPS%');
                    $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    ->get('prodi');
                    if($request->hasAny('bhsInggris')){
                        $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                        $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                        ->get('prodi');
                }
                }
                if($request->hasAny('bhsInggris')){
                    $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                    // $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    // ->get('prodi');
                    // $grup=['a'];
                
          }
        }
        if($request->hasAny('mtk')){
            $mentor->where('prodi','like','%Matematika%');
              $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
              ->get('prodi');
            // $grup=['a'];
            if($request->hasAny('ipa')){
                $mentor->orWhere('prodi','like','%IPA%');
                $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    ->get('prodi');
                if($request->hasAny('ips')){
                    $mentor->orWhere('prodi','like','%IPS%');
                    $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    ->get('prodi'); 
                    if($request->hasAny('bhsInggris')){
                        $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                        $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                        ->get('prodi');
                        // $grup=['bbb'];
                    }
                }  
            }
            if($request->hasAny('ips')){
                $mentor->orWhere('prodi','like','%IPS%');
                $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                ->get('prodi');
                // $grup=['bbb']; 
                if($request->hasAny('bhsInggris')){
                    $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                    $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    ->get('prodi');
                    // $grup=['bbb'];
                }
            }
            if($request->hasAny('bhsInggris')){
                $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                ->get('prodi');
                // $grup=['bbb'];
            }
        }
        if($request->hasAny('ipa')){
            $mentor->where('prodi','like','%IPA%');
              $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
              ->get('prodi');
            // $grup=['a'];
            if($request->hasAny('ips')){
                $mentor->orWhere('prodi','like','%IPS%');
                //   $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                //   ->get('prodi');
                $grup=['b'];
                if($request->hasAny('bhsInggris')){
                    $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                    $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                    ->get('prodi');
                    // $grup=['bbb'];
                }  
            }
        }
        if($request->hasAny('ips')){
            $mentor->where('prodi','like','%IPS%');
              $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
              ->get('prodi');
            // $grup=['a'];
            if($request->hasAny('bhsInggris')){
                $mentor->orWhere('prodi','like','%Bhs. Inggris%');
                $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
                ->get('prodi');
                // $grup=['bbb'];
            }
        } 
        if($request->hasAny('bhsInggris')){
            $mentor->where('prodi','like','%Bhs. Inggris%');
            $grup=$mentor->orderBy('pendidikanTerakhir','DESC')
            ->get('prodi');
            // $grup=['bbb'];
        }  
        }
        return count($grup)." ".json_encode( $grup);
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
        return view('profilesiswa', ['isCompleted' => $showing , 'p' => $provinsi, 'b' => $kabupaten, 'c' => $kecamatan, 'd' => $kelurahan, 'j' => $jenjang, 'tp' => $tingkatPendidikan, 'jenjang' => $show5, 'tingkatpendidikan' => $show6]);
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
        $Tbdetailsiswa->prodiSiswa=$request['prodiSiswa'];
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