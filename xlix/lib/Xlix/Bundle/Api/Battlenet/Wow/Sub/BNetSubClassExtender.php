<?php

namespace Xlix\Bundle\Api\Battlenet\Wow\Sub;

use Xlix\Bundle\Api\Battlenet\Wow\BUtils;
use Xlix\Bundle\Remote\Request;

class BNetSubClassExtender extends BUtils {

    public $currentUrl;
    public $fetches;

    public function makeWowUrl($resource) {
        return $this->base . "wow/" . $resource . "?locale=" . $this->locale;
    }

    public function getCurrentUrl() {
        return $this->makeWowUrl($this->currentUrl);
    }

    public function getUrl() {
        if (isset($this->fetches[$this->getCurrentUrl()])) {
            $obj = $this->fetches[$this->getCurrentUrl()];
        } else {
            $request = new Request();
            $data = $request->doRequest($this->getCurrentUrl());
            $obj = $this->parser['JSON']->decodeAsObject($data);
            $this->fetches[$this->getCurrentUrl()] = $obj;
        }
        return $obj;
    }
    public function getExternalUrl($url) {
        if (isset($this->fetches[$this->getCurrentUrl()])) {
            $obj = $this->fetches[$this->getCurrentUrl()];
        } else {
            $request = new Request();
            $data = $request->doRequest($url);
            $obj = $this->parser['JSON']->decodeAsObject($data);
            $this->fetches[$this->getCurrentUrl()] = $obj;
        }
        return $obj;
    }
}