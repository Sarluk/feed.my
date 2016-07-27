<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

use App\Http\Requests;

class AuthController extends Controller
{
    private $client_id = 5564551;
    private $client_secret = 'GmfOjf4XJBPbHphfNd8Q';
    private $redirect_uri = 'http://feed.my/auth';
    private $scopes = 'photos,offline';

    public function index(Request $request){
        $code = $request->code;
        if(!empty($code)){
            $client = new Client();
            $response = $client->request('GET', 'https://oauth.vk.com/access_token', [
                'query' => [
                    'client_id' => $this->client_id,
                    'redirect_uri' => $this->redirect_uri,
                    'client_secret' => $this->client_secret,
                    'code' => $code
                ]
            ]);

            $body = json_decode($response->getBody(), true);

            dd($body);
            
            return response('200');
        }else{
            return redirect('https://oauth.vk.com/authorize?client_id='.$this->client_id.'&redirect_uri='.$this->redirect_uri.'&scope='.$this->scopes.'&response_type=code');
        }


    }
}
