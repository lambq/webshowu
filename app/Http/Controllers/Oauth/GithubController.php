<?php

namespace App\Http\Controllers\Oauth;

use Redirect;
use App\User;
use Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GithubController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
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
        auth()->login($userInstance);

        return redirect('/home');
        // $user->token;
    }
}
