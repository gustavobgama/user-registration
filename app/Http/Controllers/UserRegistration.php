<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserRegistration extends Controller
{
    /**
     * Show the form.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $user = json_encode($request->session()->get('user', ['firstname' => '']));

        return view('user.create', compact('user'));
    }

    /**
     * Save partially the user data.
     *
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function save(Request $request, User $user)
    {
        // TODO: validate the request using form request
        $userData = $request->user;
        $request->session()->put('user', $userData);

        $compositeKey = [
            'firstname',
            'lastname',
            'phone',
        ];
        $compositeKeyData = array_only($userData, $compositeKey);
        $otherData = array_except($userData, $compositeKey);

        $user->updateOrCreate($compositeKeyData, $otherData);
    }
}
