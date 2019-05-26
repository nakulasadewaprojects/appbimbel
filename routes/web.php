<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/siswa/login', 'Auth\RegisterSiswaController@showRegisterForm');

Route::get('/', function () {

    return view('welcome');

})->name('welcome');

// Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/siswa/register', 'Auth\RegisterSiswaController@showRegisterForm')->name('registersiswa');
Route::post('/siswa/register', 'Auth\RegisterSiswaController@register');
Route::get('/siswa/login', 'Auth\LoginSiswaController@showLoginForm')->name('loginsiswa');
Route::post('/siswa/login', 'Auth\LoginSiswaController@login');
Route::post('logoutsiswa', 'Auth\LoginSiswaController@logout')->name('logoutsiswa');
Route::get('/dashboard', 'HomeController@dashboard');
Route::get('/dashboardsiswa', 'HomeSiswaController@dashboardsiswa');
Route::get('/myProfile', 'HomeController@myprofile');
Route::get('/profile', 'HomeController@profile');
Route::post('/profile/update/{idmentor}', 'HomeController@update');
Route::get('/tutorial', 'HomeController@tutorial');
Route::post('/tutorial/input', 'HomeController@inputTutorial');
Route::get('/jadwal', 'HomeController@jadwal');
Route::get('/approvalmentor', 'HomeController@approvalmentor');
Route::get('/payment', 'HomeController@payment');
Route::get('/report', 'HomeController@report');
Route::get('/datareport', 'HomeController@datareport');
Route::post('/report/input', 'HomeController@inputreport');
Route::get('/exportexcel', 'HomeController@exportexcel');
Route::get('/paketbimbel', 'HomeController@paketbimbel');
Route::post('/paketbimbel/input', 'HomeController@inputpaketbimbel');
Route::get('/datapaket', 'HomeController@datapaket');
Route::get('/datapaket/hapus/{id}','HomeController@hapus');
Route::get('/datapaket/editpaket/{id}','HomeController@editpaket');
Route::post('/datapaket/updatepaket','HomeController@updatepaket');
Route::get('/datatutorial', 'HomeController@datatutorial');
Route::get('/datatutorial/hapustutorial/{id}','HomeController@hapustutorial');
Route::get('/datatutorial/edittutorial/{id}','HomeController@edittutorial');
Route::post('/datatutorial/updatetutorial','HomeController@updatetutorial');
Route::get('/multimedia', 'HomeController@multimedia');
Route::post('/multimedia/input', 'HomeController@inputmultimedia'); 
Route::get('/datamultimedia', 'HomeController@datamultimedia');
Route::get('/profilesiswa', 'HomeSiswaController@profilesiswa');
Route::get('/myprofilesiswa', 'HomeSiswaController@myprofilsiswa');
Route::get('/calendarsiswa', 'HomeSiswaController@calendarsiswa');
Route::get('/multimediasiswa', 'HomeSiswaController@multimediasiswa');
Route::get('/tutorialsiswa', 'HomeSiswaController@tutorialsiswa');
Route::get('/quizsiswa', 'HomeSiswaController@quizsiswa');
Route::get('/jadwalsiswa', 'HomeSiswaController@jadwalsiswa');
Route::get('/reportsiswa', 'HomeSiswaController@reportsiswa');
Route::get('/informasipayment', 'HomeSiswaController@informasipayment');
Route::put('/profilesiswa/update/{idtbSiswa}', 'HomeSiswaController@update');
Route::put('/profile/update/{idmentor}', 'HomeController@update');
Route::get('/kabupaten/get/{id}', 'AlamatController@getKabupaten');
Route::get('/kecamatan/get/{id}', 'AlamatController@getKecamatan');
Route::get('/kelurahan/get/{id}', 'AlamatController@getKelurahan');
Route::put('/profilesiswa/update/{idmentor}', 'HomeSiswaController@update');
Route::get('/filter/get', 'FilterController@Filter');
Route::get('/detailmentor/{id}', 'HomeSiswaController@detailmentor');
// Route::get('/filterPendidikan/get', 'FilterController@Filter');
Route::get('/formAjukan/{id}', 'HomeSiswaController@formAjukan');
Route::post('/ajukan', 'HomeSiswaController@ajukan');
Route::get('/approval', 'HomeSiswaController@approval');
Route::get('/detailBimbel/{id}', 'HomeSiswaController@detailApproval');
Route::get('/detailApprovalBimbel/{id}', 'HomeController@detailApprovalMentor');
Route::post('/TerimaTolakBimbel', 'HomeController@TerimaTolakBimbel');
Route::get('/formAjukanPaket/{id}/{id2}', 'HomeSiswaController@formAjukanPaket');
Route::post('/formAjukanPaket/input', 'HomeSiswaController@AjukanPaket');



