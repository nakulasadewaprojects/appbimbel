<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use DB;
use App\Tbsiswa;
use App\Tbdetailsiswa;


class CarimentorController extends Controller{

    public function cari()
    {
        $prodi=DB::table("tbdetailsiswa")->where("idtbDetailSiswa", 6)->value("prodi");
        $pisah=explode(', ',$prodi);
        $columnprodi='prodi';
       $hitung= count($pisah);
       if($hitung==1){
        $tbdetailmentor = DB::table('tbdetailmentor')
        ->where($columnprodi, 'LIKE', '%'.$pisah[0].'%'  )
        ->pluck("idmentor");
        $tbmentor=DB::table('tbmentor')
        ->whereIN("idmentor",$tbdetailmentor)->Where("statusTutor",1)->get(); 
       }elseif($hitung==2){
        $tbdetailmentor = DB::table('tbdetailmentor')
        ->where($columnprodi, 'LIKE', '%'.$pisah[0].'%'  )
        ->orWhere($columnprodi, 'LIKE', '%'.$pisah[1].'%'  )
        ->pluck("idmentor");
        $tbmentor=DB::table('tbmentor')
        ->whereIN("idmentor",$tbdetailmentor)->Where("statusTutor",1)->get(); 
       }elseif($hitung==3){
        $tbdetailmentor = DB::table('tbdetailmentor')
        ->where($columnprodi, 'LIKE', '%'.$pisah[0].'%'  )
        ->orWhere($columnprodi, 'LIKE', '%'.$pisah[1].'%'  )
        ->orWhere($columnprodi, 'LIKE', '%'.$pisah[2].'%'  )
        ->pluck("idmentor");
        $tbmentor=DB::table('tbmentor')
        ->whereIN("idmentor",$tbdetailmentor)->Where("statusTutor",1)->get();
       }elseif($hitung==4){
        $tbdetailmentor = DB::table('tbdetailmentor')
        ->where($columnprodi, 'LIKE', '%'.$pisah[0].'%'  )
        ->orWhere($columnprodi, 'LIKE', '%'.$pisah[1].'%'  )
        ->orWhere($columnprodi, 'LIKE', '%'.$pisah[2].'%'  )
        ->orWhere($columnprodi, 'LIKE', '%'.$pisah[3].'%'  )
        ->pluck("idmentor");
        $tbmentor=DB::table('tbmentor')
        ->whereIN("idmentor",$tbdetailmentor)->Where("statusTutor",1)->get();
       }else{
        $tbdetailmentor = DB::table('tbdetailmentor')
        ->where($columnprodi, 'LIKE', '%'.$pisah[0].'%'  )
        ->orWhere($columnprodi, 'LIKE', '%'.$pisah[1].'%'  )
        ->orWhere($columnprodi, 'LIKE', '%'.$pisah[2].'%'  )
        ->orWhere($columnprodi, 'LIKE', '%'.$pisah[3].'%'  )
        ->orWhere($columnprodi, 'LIKE', '%'.$pisah[4].'%'  )
        ->pluck("idmentor");
        $tbmentor=DB::table('tbmentor')
        ->whereIN("idmentor",$tbdetailmentor)->Where("statusTutor",1)->get();
       }
        
        
         return json_encode( $tbmentor);

    }
}