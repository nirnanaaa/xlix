<?php

namespace Xlix\Bundle\File;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
class Download {
    /**
     * 
     * @param  \Corscience\DownloadBundle\Document\File $file
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getFile($file) {
        $fob = $file->getFile();
        set_time_limit(0);
        @apache_setenv('no-gzip', 1);
        @ini_set('zlib.output_compression', 0);
        $response = new Response($fob->getBytes());
        $d = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $file->getName());
        $response->headers->set('Content-Disposition', $d);
        $response->headers->set('Content-Description', 'Download by cdn12.corscience.de');
        $response->headers->set('Content-Type', $file->getMime());
        $response->headers->set('Content-Lenght', $fob->getSize());
        $response->headers->set('X-SHA1-SUM',$file->getSha1());
        $response->headers->set('Expires', 0);
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'must-revalidate, post-check=0, pre-check=0');
       // header('Content-Transfer-Encoding: binary');
        

        return $response;
    }

}

?>
