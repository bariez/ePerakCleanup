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

Route::post('/save-subscription/',function(Request $request){

  $id = $request->user_id;
  $user = \App\User::findOrFail($id);
  $subs = \App\NotUser::where('subscribable_id','=',$id)->count();

  $check = \App\NotUser::where('endpoint','=',$request->fcm_token)->first();
  if($check){

    $check->subscribable_type = 'firebase';
    $check->subscribable_id = $request->user_id;
    $check->endpoint = $request->fcm_token;
    $check->save();

    $data = [
            "to" => $request->fcm_token,
            "notification" =>
                [
                    "title" => 'Selamat Datang Ke MyTax',
                    "body" => "Selamat Datang Ke MyTax. {$user->name}, Anda akan dimaklumkan jika ada sebarang notifikasi. ",
                    "icon" => url('/logo3.jpg')
                ],
        ];
        $dataString = json_encode($data);
  
        $headers = [
            'Authorization: key=AAAAemnzbqc:APA91bH4LK36C0Su8wm2sXz8JbWqrysTClO1CKhsHyG9MMvjisU2spNdUmxfDLvUeuwv-re5ZxAPcUO4dyMyXuVFqnjEBoHN9ATpSGCbJCQoSFjF5dYkNt1lzgH-GiqEI6bcrc1Gk7_3',
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
  }else
  {

  $subsuser = new \App\NotUser;

  $subsuser->subscribable_type = 'firebase';
  $subsuser->subscribable_id = $request->user_id;
  $subsuser->endpoint = $request->fcm_token;
  $subsuser->save();

    $data = [
            "to" => $request->fcm_token,
            "notification" =>
                [
                    "title" => 'Selamat Datang Ke MyTax',
                    "body" => "Selamat Datang Ke MyTax. {$user->name}, Anda akan dimaklumkan jika ada sebarang notifikasi. ",
                    "icon" => url('/logo3.jpg')
                ],
        ];
        $dataString = json_encode($data);
  
        $headers = [
            'Authorization: key=AAAAemnzbqc:APA91bH4LK36C0Su8wm2sXz8JbWqrysTClO1CKhsHyG9MMvjisU2spNdUmxfDLvUeuwv-re5ZxAPcUO4dyMyXuVFqnjEBoHN9ATpSGCbJCQoSFjF5dYkNt1lzgH-GiqEI6bcrc1Gk7_3',
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






Route::any('/send-notification/{id}', function($id, Request $request){
  $user = \App\User::findOrFail($id);

  $user = \App\NotUser::where('subscribable_id','=',$id)->get();

  foreach ($user as $key => $value) {
      $data = [
            "to" => $value->endpoint,
            "notification" =>
                [
                    "title" => 'Web Push',
                    "body" => "Sample Notification",
                    "icon" => url('/logo3.png')
                ],
        ];
        $dataString = json_encode($data);
  
        $headers = [
            'Authorization: key=' . $this->serverKey,
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