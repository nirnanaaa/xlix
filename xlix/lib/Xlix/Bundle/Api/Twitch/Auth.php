<?php

namespace Xlix\Bundle\Api\Twitch;

use Xlix\Bundle\Remote\Request;
use Xlix\Bundle\Parser\Yaml\YamlParser;
use Xlix\Bundle\Api\Providers\OAuthConsumer;
use Xlix\Bundle\Api\Providers\OAuthSignatureHMACSHA1;
use Xlix\Bundle\Api\Providers\OAuthRequest;

class Auth {

    private $parser;
    private $request;
    private $config;

    public function __construct() {
        $this->parser = new YamlParser;
        $this->config = $this->parser->parseXlixConfig()->api['twitch'];
        $this->request = new Request();
        // print_r($this->config);
        // break;
    }

    public function authUser() {
        $test_consumer = new OAuthConsumer($this->config['key'], $this->config['secret'], NULL);
        $sig_method = new OAuthSignatureHMACSHA1();
        $parsed = parse_url($this->config['reqtoken']);
        $params = array('callback' => $this->config['callbase']);
        parse_str($parsed['query'], $params);

        
        $req_req = OAuthRequest::from_consumer_and_token($test_consumer, NULL, "GET", $this->config['reqtoken'], array('callback' => $this->config['callbase']));
        $req_req->sign_request($sig_method, $test_consumer, NULL);
        $req_token = $this->request->doRequest($req_req->to_url());
        parse_str($req_token, $tokens);
        $oauth_token = $tokens['oauth_token'];
        $oauth_token_secret = $tokens['oauth_token_secret'];
        $callback_url = "{$this->config['callbase']}?key={$this->config['key']}&token=$oauth_token&token_secret=$oauth_token_secret&endpoint="
                . urlencode($this->config['authorize']);
        $auth_url = $this->config['authorize'] . "?oauth_token=$oauth_token&oauth_callback={$callback_url}";
        Header("Location: $auth_url");
    }

}

?>
