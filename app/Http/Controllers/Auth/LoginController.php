<?php


namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except('login');
    }

  /**
   * @param LoginRequest $request
   */
  public function login(LoginRequest $request)
  {
    // find a user by email
    $user = User::whereEmail($request->email)->first();

    // check user
    if ($user && Hash::check($request->password, $user->password)) {
      $user->api_token = Str::random(60);
      $user->save();

      return response()->json([
        'userId' => $user->id,
        'accessToken' => $user->api_token,
        'name' => $user->name,
      ]);
    }


    return response()->json([
      'errors' => [
        'message' => 'Электронный адрес или пароль, который вы указали, не соответствует ни одному аккаунту.'
      ]
    ], 422);
  }

  public function logout()
  {
    $user = Auth::user();
    $user->api_token = null;
    $user->save();

    return response()->json([
      'success' => true
    ]);
  }
}
