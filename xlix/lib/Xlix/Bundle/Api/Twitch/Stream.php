<?php

namespace Shades\ApiBundle\Twitch;
use Shades\SystemBundle\Curl\Get;
class Stream {

    public function getStreams($dbconn) {
        $dataBaseResultString = $dbconn->fetchAll("SELECT * FROM bs_streams");
        foreach ($dataBaseResultString as $dbRes) {
            $json_array_pre_compile[$dbRes['channel']]['active'] = $dbRes[active];
            $json_array_pre_compile[$dbRes['channel']]['id'] = $dbRes[id];
            $json_array_pre_compile[$dbRes['channel']]['chat'] = $dbRes[chat];
            $json_array_pre_compile[$dbRes['channel']]['channel'] = $dbRes[channel];
            $json_array_pre_compile[$dbRes['channel']]['wowchar'] = $dbRes[wowchar];
            $json_array_pre_compile[$dbRes['channel']]['status'] = ($this->streamStatus($dbRes['channel']) ? "online" : "offline");
            $infos = $this->getStreamInfo($dbRes['channel']);
            if ($json_array_pre_compile[$dbRes['channel']]['status'] == "offline") {
                $json_array_pre_compile[$dbRes['channel']]['picture'] = $infos->image_url_large;
            } else {
                $json_array_pre_compile[$dbRes['channel']]['picture'] = $infos->screen_cap_url_large;
            }

            $json_array_pre_compile[$dbRes['channel']]['title'] = $infos->status;
            $json_array_pre_compile[$dbRes['channel']]['totalViews'] = $infos->views_count;
        }
        return($json_array_pre_compile);
    }

    public function streamStatus($streamer) {
        $Url = "http://api.justin.tv/api/stream/list.json?channel=" . $streamer;
        $response = Get::getCachedUrl($Url,60);
        if (!isset($response)) {
            return(false);
        }
        if (strlen($response) <= 2) {
            return(false);
        }
        if ($response == "[]") {
            return(false);
        }
        if (strlen($response) >= 20) {
            return(true);
        }
    }

    public function getStreamInfo($channel) {

        return json_decode(json_encode(simplexml_load_string(Get::getCachedUrl("http://api.justin.tv/api/channel/show/" . $channel . ".xml", 1200))));
    }

}

?>
