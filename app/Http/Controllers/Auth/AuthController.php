<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\User, Validator, Socialite, Auth, Redirect;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($service)
    {
        $user = Socialite::driver($service)->user();

        if($service == 'github'){
            if(!$userinfo = User::where('email', $user->email )->first()){
                if(!$userinfo = User::where('github_id', $user->id )->first()){
                    $userModel = new User;
                    $userModel->github_id = $user->id;
                    $userModel->email = $user->email;
                    $userModel->name = $user->name ? $user->name : $user->nickname ;
                    $userModel->avatar = $user->avatar;
                    $userModel->save();
                }else{
                    $userData['github_id'] = $user->id;
                    $userData['avatar'] = $user->avatar;
                    $userData['name'] = $user->name ? $user->name : $user->nickname ;
                    User::where('github_id', $user->id )->update($userData);
                }
            }else{
                $userData['github_id'] = $user->id;
                $userData['avatar'] = $user->avatar;
                $userData['name'] = $user->name ? $user->name : $user->nickname ;
                User::where('email', $user->email )->update($userData);
            }
            $userInstance = User::where('github_id',$user->id)->firstOrFail();
            Auth::login($userInstance);

            return redirect('/home');
        }

        if($service == 'qq'){
            if(!$userinfo = User::where('email', $user->email )->first()){
                if(!$userinfo = User::where('github_id', $user->id )->first()){
                    $userModel = new User;
                    $userModel->github_id = $user->id;
                    $userModel->email = $user->email;
                    $userModel->name = $user->name ? $user->name : $user->nickname ;
                    $userModel->avatar = $user->avatar;
                    $userModel->save();
                }else{
                    $userData['github_id'] = $user->id;
                    $userData['avatar'] = $user->avatar;
                    $userData['name'] = $user->name ? $user->name : $user->nickname ;
                    User::where('github_id', $user->id )->update($userData);
                }
            }else{
                $userData['github_id'] = $user->id;
                $userData['avatar'] = $user->avatar;
                $userData['name'] = $user->name ? $user->name : $user->nickname ;
                User::where('email', $user->email )->update($userData);
            }
            $userInstance = User::where('github_id',$user->id)->firstOrFail();
            Auth::login($userInstance);

            return redirect('/home');
        }
    }
}
