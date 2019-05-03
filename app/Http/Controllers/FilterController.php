<?Php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Routing\Controller;
use DB;
use File;
use App\Tbsiswa;
use App\Tbdetailsiswa;

class FilterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:siswa');
    }

    public function FilterTingkatPendidikan()
    {
        $mentor=DB::table('tbmentor')
        ->join('tbdetailmentor','tbmentor.idmentor','=','tbdetailmentor.idmentor')->where('statKomplit',7)->where('statusTutor',1);
        $grup=$mentor->orderBy('pendidikanTerakhir','DESC')->get();
        $showing = DB::table('tbdetailsiswa')->where('idtbDetailSiswa', Auth::user()->idtbSiswa)->first();
        return view('filterTingPend', ['isCompleted' => $showing, 'filter' => $grup ]);
        // return  $showing;
    }
        
}