<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function login(Request $request)     
    {
        $hasher = app()->make('hash');
        $email = $request->email;
        $password = $request->password;

        $login = User::where(['email'=> $email, 'hak_akses'=>'2'])->first();

        if(!$login){

            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Maaf email anda tidak terdaftar',
                
            ], 201);

        }else{
            if($hasher->check($password, $login->password)){

                $data = User::where('id', $login->id)->first();

                $update = User::find($login->id)->update([
                    'remember_token' => $request->token,
                    // 'email_verified_at' => $request->token,
                ]);

                if ($update) {
                   return response()->json([
                        'responsecode' => '1',
                        'responsemsg' => 'Selamat datang',
                        'user' => $data
                    ], 201);
                } else {
                   return response()->json([
                        'responsecode' => '0',
                        'responsemsg' => 'Gagal Update Token',
                        'user' => $data
                    ], 201);
                }
                
                    
                
            }else{
                return response()->json([
                    'responsecode' => '0',
                    'responsemsg' => 'Maaf password anda salah',
                    
                ], 201);
            }
        }

    }
}
