<?php

namespace Xlix\Bundle\Validation;

class NetworkValidation {

    public function isValidIpDiget($ip) {
        return !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE);
    }

    public function isMailExisting() {
        
    }

    public function isIpv4($ip) {
        return preg_match('/^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$/',$ip);
    }

    public function isIpv6($ip) {
        return preg_match('/^(?>(?>([a-f0-9]{1,4})(?>:(?1)){7}|(?!(?:.*[a-f0-9](?>:|$)){7,})((?1)(?>:(?1)){0,5})?::(?2)?)|(?>(?>(?1)(?>:(?1)){5}:|(?!(?:.*[a-f0-9]:){5,})(?3)?::(?>((?1)(?>:(?1)){0,3}):)?)?(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])(?>\.(?4)){3}))$/iD',$ip) ;
    }

}
