<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Candidate;
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

Route::get('/', function () {
    return view('welcome');
});
Route::post('/register-candidate', function (Request $request) {
    Candidate::create([
        'name' => $request->name,
        'phone_number' => $request->phone,
        'email' => $request->email
    ]);
    dd("saved record");
});
Route::get('/search-candidate/{id_candidate}', function ($id_candidate) {
    $candidate = Candidate::findOrFail($id_candidate);
    //echo $candidate;
    echo $candidate->name;
    echo "<br/>";
    echo $candidate->phone_number;
    echo "<br/>";
    echo $candidate->email;      
});
Route::get('/edit-candidate/{id_candidate}', function ($id_candidate) {
    $candidate = Candidate::findOrFail($id_candidate);
    return view('edit_candidate', ['candidate' =>$candidate]);
});
Route::put('/update-candidate/{id_candidate}', function (Request $request, $id_candidate) {
    $candidate = Candidate::findOrFail($id_candidate);
    $candidate->name = $request->name;
    $candidate->phone_number = $request->phone;
    $candidate->email = $request->email;
    $candidate->save();
    echo "updated data!";
    
});
Route::get('/delete-candidate/{id_candidate}', function (Request $request, $id_candidate) {
    $candidate = Candidate::findOrFail($id_candidate);
    $candidate->delete();
    echo "deleted data";
});