<?php

namespace Xlix\Bundle\File;

use Xlix\Bundle\File\Exception\FileNotFoundException;

class FileSystem {

    public function fileExists($file) {
        if (!file_exists($file) || !is_dir($file)) {
            throw new FileNotFoundException('file/directory does not exist');
        }
        return true;
    }

    public function deleteFile($file) {
        $this->fileExists($file);
        unlink($file);
    }

    public function chmod($file, $mod = 0755) {
        $this->fileExists($file);
        return chmod($file, $mod);
    }

    public function rmDir($dir, $recursiv = true) {
        if ($recursiv) {
            $files = array_diff(scandir($dir), array('.', '..'));
            foreach ($files as $file) {
                (is_dir("$dir/$file")) ? $this->rmDir("$dir/$file") : unlink("$dir/$file");
            }
            return rmdir($dir);
        } else {
            rmdir($dir);
        }
    }

    public function mkDir($dir, $mod = 0755) {
        return mkdir($dir, $mod, true);
    }

    public function touchFile($file) {
        return touch($file);
    }

    public function rename($resource, $newresource) {
        return rename($resource, $newresource);
    }

    public function listDir($directory, $recursive = true, $listDirs = false, $listFiles = true, $exclude = '') {
        $arrayItems = array();
        $skipByExclude = false;
        $handle = opendir($directory);
        if ($handle) {
            while (false !== ($file = readdir($handle))) {
                preg_match("/(^(([\.]){1,2})$|(\.(svn|git|md))|(Thumbs\.db|\.DS_STORE))$/iu", $file, $skip);
                if ($exclude) {
                    preg_match($exclude, $file, $skipByExclude);
                }
                if (!$skip && !$skipByExclude) {
                    if (is_dir($directory . DIRECTORY_SEPARATOR . $file)) {
                        if ($recursive) {
                            $arrayItems = array_merge($arrayItems, $this->directoryToArray($directory . DIRECTORY_SEPARATOR . $file, $recursive, $listDirs, $listFiles, $exclude));
                        }
                        if ($listDirs) {
                            $file = $directory . DIRECTORY_SEPARATOR . $file;
                            $arrayItems[] = $file;
                        }
                    } else {
                        if ($listFiles) {
                            $file = $directory . DIRECTORY_SEPARATOR . $file;
                            $arrayItems[] = $file;
                        }
                    }
                }
            }
            closedir($handle);
        }
        return $arrayItems;
    }

    public function getDiskUsage($dir) {
        $this->fileExists($dir);
        return disk_free_space($dir);
    }

    public function getLastModTime($resource) {
        $this->fileExists($resource);
        return filemtime($resource);
    }

    public function getLastAccessTime($file) {
        $this->fileExists($resource);
        return fileatime($resource);
    }

    public function isDirReadable($dir) {
        $this->fileExists($dir);
        return is_readable($dir);
    }

    public function getFilePerms($file) {
        $this->fileExists($file);
        return fileperms($file);
    }

    public function getOwner($file) {
        $this->fileExists($file);
        return fileowner($file);
    }

    public function getOwnerGroup($file) {
        $this->fileExists($file);
        return filegroup($file);
    }

    public function getFileType($file) {
        $this->fileExists($file);
        return filetype($file);
    }

    public function getFileInfo($file) {
        $this->fileExists($file);
        return stat($file);
    }

}