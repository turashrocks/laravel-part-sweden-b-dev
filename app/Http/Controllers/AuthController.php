<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */

class AuthController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:api')->except(['login', 'register']);
    }
    // public function register(Request $request, $token)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|unique:users',
    //         'password' => 'required|confirmed',
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password)
    //     ]);

    //     return response()->json([
    //         'message'=>'successfully registered',
    //         'user'=>$user,
    //         'token'=>$token
    //     ]);
    // }

    public function responseToken($token)
    {
        return response()->json([
            'access_token'=>$token,
            'type'=>'Bearer',
            'expires_in'=>auth()->factory()->getTTL()*60,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|exists:users',
            'password'=>'required'
        ]);

        if(!$token = auth()->attempt($request->all())){
            return response()->json([
                'message'=>'Unauthorized'
            ],401);
        }

        return $this->responseToken($token);
    }

    public function refresh()
    {
        return $this->responseToken(auth()->refresh());
    }

    public function user()
    {
        // return auth()->user();
        return User::paginate();
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'message'=>'successfully logged out'
        ]);
    }


}
