<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use GuzzleHttp\Client;

use App\Http\Services\DiscordService;

class DiscordController extends Controller
{

    private $url = 'https://discord.com/api/v10/guilds/1150126011036487723/members?limit=200';

    public function getGuildMembersList(Request $request)
    {
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => config('discord.bot_token'),
        ];
        $response = $client->request('GET', $this->url, [
            'headers' => $headers,
        ]);
        $data = json_decode($response->getBody(),true);
        return response()->json($data, 200);
    }


    public function verifyMember(Request $request)
    {
        // return config('discord.bot_token');
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => config('discord.bot_token'),
        ];
        $response = $client->request('GET', $this->url, [
            'headers' => $headers,
        ]);
        $data = json_decode($response->getBody(),true);

        $members = [];

        for($i=0;$i < count($data); $i++)
        {
            $handler = [
                'username' => $data[$i]['user']['username'],
            ];

            array_push($members,$handler);
        }

        $voterUsername = [
            'username' => $request->discord_username,
        ];

        if(in_array($voterUsername, $members)){
            return response()->json([
                'message' => 'Voter is a member of the discord community',
                'canVote' => true,
            ], 200);
        }else{
            return response()->json([
                'message' => 'Voter is not a member of the discord community',
                'canVote' => false,
            ], 200);
        }
    }
}
