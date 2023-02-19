<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryApiController;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::get('/categories',[CategoryApiController::class,'index']);
// Route::get('/categories',[CategoryApiController::class,'detail']);
// Route::post('/categories',[CategoryApiController::class,'create']);
// Route::put('/categories',[CategoryApiController::class,'update']);
// Route::patch('/categories',[CategoryApiController::class,'update']);
// Route::delete('/categories',[CategoryApiController::class,'delete']);

Route::apiResource('/categories', CategoryApiController::class)
    ->middleware('auth:senctum');

// Route::post('/login',function(){
//     $email = request()->email;
//     $password = request()->password;

//     $user = User::where("email",$email)->first();
//     if($user){
//         if(password_verify($password, $user->password)){
//             return $user->createToken('device')->plainTextToken;
//         }
//     }

//     return response(['msg' => 'invalid email or password'], 403);
// })->middleware('auth-senctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


