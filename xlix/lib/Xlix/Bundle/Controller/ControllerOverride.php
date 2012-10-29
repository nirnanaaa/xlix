<?php

namespace Xlix\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Xlix\Bundle\File\Download;
use Xlix\Bundle\Authentication\ValidateAuthentication;
use Xlix\Bundle\File\Exception\FileNotFoundException;

class ControllerOverride extends Controller {

    public function getName() {
        return get_class($this);
    }

    public function redirectToHome() {
        $this->redirect('/');
    }

    public function downloadFile($location, $filename, $mime = 'application/octet-stream') {
        $dController = new Download($location);
        return $dController->getFile($mime, $filename);
    }

    public function validateAuthentication($password = null, $hash = null, $salt = null) {
        $authentication = new ValidateAuthentication();
        $authentication->auth($password, $hash, $salt);
    }

    public function validateApiAuthentication() {
        $authentication = new ValidateAuthentication();
        $authentication->authAPI($this->getRequest());
    }

    public function getORM() {
        return $this->getDoctrine()->getManager();
    }

    public function checkFileAge($file, $maxage) {
        if (file_exists($file)) {
            $moddate = filemtime($file);
            $offset = $moddate + $maxage * 60;
            if ($offset > time()) {
                return true;
            } else {
                return false;
            }
        } else {
            throw new FileNotFoundException("The file was not found in the filesystem");
        }
    }

    public function deleteFile($file) {
        if (file_exists($file)) {
            unlink($file);
        } else {
            throw new FileNotFoundException("The file was not found in the filesystem");
        }
    }

}

?>
