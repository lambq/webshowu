<?php
namespace App\Http\Libraries;

use GuzzleHttp\Client;

class BearyChatRobot
{
    public static function notify($title, $content)
    {
        if (!env('BEARYCHAT_HOOK')) {
            return;
        }

        $client = new Client();

        $data                   = [];
        $data['text']           = $title;
        $data['attachments'][]  = ['text' => $content];

        $client->request('POST', env('BEARYCHAT_HOOK'), [
            'form_params' => ['payload' => json_encode($data)]
        ]);
    }
}