<?php

namespace App\Http\Controllers\Auth;

use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only([ 'email', 'password' ]);
     

        // if ($credentials->email == 'user@mail.com' && $credentials->password == 'pass123'){

            try {
                // attempt to verify the credentials and create a token for the user
                if (! $token = \JWTAuth::attempt($credentials)) {
    
                    return response()->json(['error' => 'invalid_credentials'], 401);
                }
            } catch (JWTException $e) {
        
                // something went wrong whilst attempting to encode the token
                return response()->json(['error' => 'could_not_create_token'], 500);
            }
    
            $user = User::where('email', $request['email'])->get()->first();
            $user = array(
                'id' => $user->id,
			    'email' => $user->email,
			    'password' => $user->password
            );
    
            return response()->json(compact('token','user'));

        // }

        // else {
        //     return response()->json(['error' => 'invalid_credentials, admin user and pass required'], 500);
        // }
     
    }

}