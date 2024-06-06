<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * To display a login form
     */
    public function login()
    {
        return view('users.connexion');
    }


    /**
     * To logout
     */
    public function logout()
    {
        Auth::logout();
        return to_route('login')->with('success', 'Deconnecté avec succès');
    }


    /**
     * To login
     * @param LoginRequest $request
     */
    public function log(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            return redirect()->intended(route('filter.today'))->with('success', "Bienvenue $user->name");
        }
        return to_route('login')->withErrors(['email' => "Erreur d'authentification", 'password' => "Erreur d'authentification"])->onlyInput('email');
    }

    /** display a registering form*/

    public function registerForm()
    {
        return view('users.registration');
    }

    /** Register in data base
     * @param RegisterRequest $request
     */
    public function register(RegisterRequest $request)
    {

        $query = User::query();
        $data = $request->validated();
//        dd($request['conf_password']);
//        dd($data);
        if ($data['password'] === $data['conf_password']) {
            $data['password'] = Hash::make($data['password']);
            // $data['conf_password'] = Hash::make($data['conf_password']);
            $query->create($data);

            return redirect()->route('login')->with('success', 'Vous avez été enregisté avec succès');
        }
        $errors['conf_password'] = 'Veuillez saisir les mêmes mots de passe';
        return to_route('register')->withErrors(['conf_password' => 'Veuillez saisir les mêmes mots de passe'])->onlyInput('conf_password');


    }
}
