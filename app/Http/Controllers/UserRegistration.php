<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use GuzzleHttp\Client;

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
     * @param Client $client
     * @return void
     */
    public function save(Request $request, User $user, Client $client)
    {
        // TODO: validate the request using a form request class
        $userData = $request->user;
        $request->session()->put('user', $userData);

        $compositeKey = [
            'firstname',
            'lastname',
            'phone',
        ];
        $compositeKeyData = array_only($userData, $compositeKey);
        $otherData = array_except($userData, $compositeKey);

        if ($request->step === 3) {
            $currentUser = $user->where('firstname', $compositeKeyData['firstname'])
                 ->where('lastname', $compositeKeyData['lastname'])
                 ->where('phone', $compositeKeyData['phone'])
                 ->firstOrFail();

            $data = [
                'customerId' => $currentUser->id,
                'iban' => $otherData['iban'],
                'owner' => $otherData['account_owner'],
            ];
            $response = $client->post('', [
                'json' => $data,
            ]);
            $response = json_decode((string) $response->getBody(), true);

            $otherData['paymentdata_id'] = $response['paymentDataId'];
            $request->session()->flush();
        }

        $user->updateOrCreate($compositeKeyData, $otherData);

        if (isset($otherData['paymentdata_id'])) {
            return $otherData['paymentdata_id'];
        }
    }
}
