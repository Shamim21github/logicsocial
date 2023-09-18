<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TwitterService
{
    private $consumerKey;
    private $consumerSecret;
    private $accessToken;
    private $accessTokenSecret;
    private $signatureMethod = 'HMAC-SHA1';
    private $oauthVersion = '1.0';

    public function __construct()
    {
        $this->consumerKey = config('services.twitter.client_id');
        $this->consumerSecret = config('services.twitter.client_secret');
        $this->accessToken = config('services.twitter.access_token');
        $this->accessTokenSecret = config('services.twitter.access_token_secret');
    }

    public function tweet($status)
    {
        $url = 'https://api.twitter.com/1.1/statuses/update.json';
        $httpRequestMethod = 'POST';

        $params = [
            'status' => $status,
            'oauth_consumer_key' => $this->consumerKey,
            'oauth_nonce' => $this->getToken(42),
            'oauth_signature_method' => $this->signatureMethod,
            'oauth_timestamp' => time(),
            'oauth_token' => $this->accessToken,
            'oauth_version' => $this->oauthVersion,
        ];

        $params['oauth_signature'] = $this->createSignature($httpRequestMethod, $url, $params);

        $response = Http::asForm()->post($url, $params);

        return $response->json();
    }

    private function getToken($length)
    {
       
    }

    private function createSignature($httpRequestMethod, $url, $params)
    {
       
    }
}
