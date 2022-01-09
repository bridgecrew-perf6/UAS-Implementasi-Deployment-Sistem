<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class GoogleController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {    
        // $user = Socialite::driver('google')->user();
        $user = Socialite::driver('google')->stateless()->user();
        if(explode("@", $user->email)[1] !== 'vokasi.unair.ac.id'){
            // return redirect()->to('/');
            return redirect('/')->with('alert_gagal_login','gagal');
        }
        Session::put('login',TRUE);
        Session::put('id',$user->getId());
        Session::put('nama',$user->getName());
        Session::put('email',$user->getEmail());
        Session::put('foto',$user->getAvatar());
        return redirect ('home');
    }

    public function logout(){
        Session::flush();
        return redirect ('/');
    }
     /*
     The redirect Metode mengurus pengiriman pengguna ke penyedia OAuth, sedangkan usermetode akan 
     membaca permintaan yang masuk dan mengambil informasi pengguna dari provider.


     1.Stateless Authentication
        The stateless method may be used to disable session state verification. 
        This is useful when adding social authentication to an API:

        return Socialite::driver('google')->stateless()->user();
    
     2.Retrieving User Details
        $user = Socialite::driver('github')->user();

        // OAuth Two Providers
        $token = $user->token;
        $refreshToken = $user->refreshToken; // not always provided
        $expiresIn = $user->expiresIn;

        // OAuth One Providers
        $token = $user->token;
        $tokenSecret = $user->tokenSecret;

        // All Providers
        $user->getId();
        $user->getNickname();
        $user->getName();
        $user->getEmail();
        $user->getAvatar();

        3.Session
            Session::flush(); untuk logout
            Session::put('coba',$data->first_name2);
            {{Session::get('coba')}}
            if(!Session::get('login'))
            */

}
