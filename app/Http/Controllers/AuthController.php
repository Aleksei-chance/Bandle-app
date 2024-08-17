<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function AuthPage() {
        return view('auth.index');
    }

    public function registration(Request $request) {
        // var_dump($request); exit();

        $validator = Validator::make($request->all(), [
            'email' => ["required", "email", "string", "unique:users,email"]
            , "password" => ["required", "confirmed"]
        ]);

        
        if ($validator->fails()) 
        {
            $messages = $validator->errors()->messages();
            $errors = array();
            foreach($messages as $key => $massage) {
                foreach($massage as $Item) {
                    $errors[] = $key.":".$Item;
                }
            }

            return implode("|", $errors);
        }

        $data = $validator->validated();

        if($user = User::create($data)) {
            auth( guard: "web")->login($user);
            return 1;
        }

        return 0;
    }

    public function logout() {
        auth(guard: "web")->logout();
    }

    public function login(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => ["required", "email", "string"]
            , "password" => ["required"]
        ]);

        if ($validator->fails()) 
        {
            $messages = $validator->errors()->messages();
            $errors = array();
            foreach($messages as $key => $massage) {
                foreach($massage as $Item) {
                    $errors[] = $key."_login:".$Item;
                }
            }

            return implode("|", $errors);
        }

        $data = $validator->validated();

        if(auth(guard: "web")->attempt($data)) {
            return 1;
        }
        return "email_login:|password_login:Wrong data";
    }
}
