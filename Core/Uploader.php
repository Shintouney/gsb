<?php

class Uploader
{
    public function preUpload($file)
    {
        $pos_extension = strpos($file['name'], '.');
        $extension = substr($file['name'], $pos_extension);
        $newName = uniqid().$extension;

        return $newName;
    }

    public function upload($file, $name, $dir = null)
    {
        $dir = $dir? $dir: $this->getFilePath();
        if(!is_dir($dir)){
            if(!mkdir($dir, '0777', true )){
                throw new \Exception('repertoire non cree');
            }
        }
        $name = $dir.D_S.$name;
        if( $file['file']['error'] === UPLOAD_ERR_OK && is_uploaded_file($file['tmp_name'])) {
            $moved = move_uploaded_file($file['tmp_name'], $name);
            if ($moved) {
                return $name;
            } // TODO else throw exception
        }

        return false;
    }

    public function read($file)
    {
        $data = '';
        $fh = fopen($file['name'], "r");
        while (!feof($fh)) {
            $data.= fgetss($fh);
        } 
        fclose($fh);

        return $data;
    }

    public function getFilePath()
    {
        return  ROOT.D_S.'img'.D_S;
    }
} 