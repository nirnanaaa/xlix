<?php

namespace Xlix\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Xlix\Bundle\File\Download;
use Xlix\Bundle\Authentication\ValidateAuthentication;
use Xlix\Bundle\File\Exception\FileNotFoundException;
use Xlix\Bundle\Validation\NetworkValidation;
use Xlix\Bundle\Parser\Yaml\YamlParser;
use Xlix\Bundle\Plugin\Loader;
use Symfony\Component\HttpFoundation\Response;

class ControllerOverride extends Controller {

    protected $_provider;
    protected $_storage;
    protected $_xlixCfg;

    public function __construct() {
        
    }

    public function sendmail($to, $from, $subject, $text) {
        $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom($from)
                ->setTo($to)
                ->setBody($text)
        ;
        $this->get('mailer')->send($message);
    }

    public function systemMail($to, $subject, $text) {
        $this->sendmail($to, $this->getXlixConfig()->mailer['from'], $subject, $text);
    }

    public function getPluginLoader() {
        return new Loader();
    }

    public function getName() {
        return get_class($this);
    }

    public function getValidator() {
        return new NetworkValidation();
    }

    public function getXlixConfig() {
        if ($this->_xlixCfg instanceof YamlParser) {
            $yamlparser = $this->_xlixCfg;
        } else {
            $yamlparser = new YamlParser();
            $this->_xlixCfg = $yamlparser;
        }

        return $yamlparser->parseXlixConfig();
    }

    public function getSymfonyConfig() {
        $yamlparser = new YamlParser();
        return $yamlparser->parseSymfonyConfig();
    }

    public function getYamlConfig($file) {
        $yamlparser = new YamlParser();
        if (file_exists($file)) {
            return $yamlparser->parseFile($file);
        }
        return null;
    }

    public function getFormParamValue($param) {
        return($this->getRequest()->request->get($param));
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
            throw new FileNotFoundException("The file was not found on the filesystem");
        }
    }

    public function deleteFile($file) {
        if (file_exists($file)) {
            unlink($file);
        } else {
            throw new FileNotFoundException("The file was not found on the filesystem");
        }
    }

    public function renderError($msg, $status = 500) {
        $response = new Response();
        $response->setStatusCode($status);
        $response->setContent($this->renderView(
                        $this->getXlixConfig()->providers['error'], array('error' => $msg)
                ));
        return $response;
    }

    public function renderAction($msg) {
        return $this->render($this->getXlixConfig()->providers['action'], array('action' => $msg));
    }

    public function removeWhitespacesFromString($string) {
        return str_replace(" ", "", $string);
    }

    public function getRepo($inner, $namespace = 0) {
        $outer = $this->getXlixConfig()->database['EntityNamespaces'][$namespace];
        return $this->getDoctrine()->getRepository($outer . ":" . $inner);
    }

    public function renderDefault($inner, $load = array(), $namespace = 0) {
        $outer = $this->getXlixConfig()->database['EntityNamespaces'][$namespace];
        return $this->render($outer . ":" . $inner, $load);
    }

}

?>
