<?php
$serverkey = 'AAAAvpQ6IIg:APA91bGz1t32_fTgodro6OtlvAEigXTXj5Kiln2CzON0D20ldroHFaGyZ_zmdqv2GGiLBqW8QA1kP0igIvKIfl-N2v4zzpeMu5MEGfe3XgIEvjNlZEXWepc3kSZQq83H8SXZcIvuoOAu';
        $token = 'fARBHt7eSVqTDSm681Mv8j:APA91bEeIqIP3vb9YHzNCHsi3bPqtyMDBlwkWQCv-cnr2M4pDoD-79Uj6VGqyeOV14etSMK1IG9Pl80Fr7tRF41jSZNemUibQ0hDyKEQ2OXJppw_-2oGAL3nJ8NkiX6jqfDn-cEKtXoR';
        $url = "https://fcm.googleapis.com/fcm/send";   
        $header = [
            'authorization: key='.$serverkey,
            'content-type: application/json'
        ];
        $id = "1";
        $notification = [
            'title' => 'GoPayment',
            'body' => 'Topup Sukses'
        ];
        $extraNotificationData = ["message" => $notification,"id" =>$id,"type" =>0];

        $fcmNotification = [
            'to'        => $token,
            'notification' => $notification,
            'priority'          => 'high', 
            'data' => $extraNotificationData
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch); 
        curl_close($ch);
        return $result;
?>