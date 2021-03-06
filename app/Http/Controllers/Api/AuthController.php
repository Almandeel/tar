<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Account;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login' ,'register']]);
    }

    public function register(Request $request) {

        // $request->validate([
        //     'name' => 'required',
        //     'phone' => 'required | unique:users',
        // ]);

        $user = User::create([
            'name'      => $request['name'],
            'phone'     => $request['phone'],
            'address'   => $request['address'],
            'code'      => $request['code'],
            'password'  => Hash::make($request['password']),
            'fcm_token' => $request['fcm_token'],
        ]);

        if($request->type == 'company') {

            $account = Account::create([
                'name' => 'company'
            ]);

            $company = Company::create([
                'name' => $request['name'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'account_id' => $account->id,
            ]);

            $user->update([
                'company_id' => $company->id,
                'status'     => 0,
            ]);
            $user->attachRole('company');
        }else {
            $user->attachRole('customer');
        }

        $credentials = request(['phone', 'password']);


        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (auth('api')->user()->status == 0) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token, $user);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['phone', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user  = auth('api')->user();

        if ($user->status == 0) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        return $this->respondWithToken($token, $user);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh(), auth('api')->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token , $user)
    {
        return response()->json([
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'id'            => $user['id'],
            'name'          => $user['name'],
            'phone'         => $user['phone'],
            'company_id'    => $user['company_id'],
            'expires_in'    => auth('api')->factory()->getTTL() * 60 * 24 * 365
        ]);
    }
}
