<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Utils;

class Tunnelbroker {

    public $heTunnelBrokerUrl = "https://ipv4.tunnelbroker.net/ipv4_end.php?ipv4b=%s&pass=%s&user_id=%s&tunnel_id=%s";
    private $user;
    private $password;
    private $ip;
    private $tunnelid;

    public function __construct($username, $password, $ip, $tunnelid) {
        $this->user = $username;
        $this->password = $password;
        $this->ip = $ip;
        $this->tunnelid = $tunnelid;
    }

    public function updateTunnel() {
        $request = new \Xlix\Bundle\Remote\Request();
        $update = $request->doRequest(
                sprintf($this->heTunnelBrokerUrl, $this->ip, $this->password, $this->user, $this->tunnelid)
        );
        if (preg_match("#error#i", $update)) {
            return "Something went terrible wrong!";
        } elseif (preg_match("#ok#i", $update)) {
            return "Everything seems good";
        }
    }

}

?>
