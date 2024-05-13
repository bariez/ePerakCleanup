<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/send-notification/{id}', function ($id, Request $request) {
    $user = \App\User::findOrFail($id);

    $user = \App\NotUser::where('subscribable_id', '=', $id)->get();

    foreach ($user as $key => $value) {
        $data = [
            'to' => $value->endpoint,
            'notification' => [
                'title' => 'Web Push',
                'body' => 'Sample Notification',
                'icon' => url('/logo3.png'),
            ],
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key='.$this->serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        curl_exec($ch);

        return response()->json(['success' => true]);
    }
});
