<?php

class File
{
    // attribue un nom de fichier aléatoire à un fichier téléchargé
    public static function preUpload($file)
    {
        $pos_extension = strpos($file['name'], '.');
        $extension = substr($file['name'], $pos_extension);
        $newName = uniqid().$extension;

        return $newName;
    }

    // télécharge un fichier dans un répertoire défini
    public static function upload($file, $name = '', $dir = null)
    {
        $dir = $dir ? self::getImagePath($dir): self::getImagePath();
        $name = $name ? : $file['name'];
        if(!is_dir($dir)){
            if(!mkdir($dir, '0777', true )){
                throw new \Exception('repertoire non cree');
            }
        }
        $name = $dir.D_S.$name;
		
       // if( $file['error'] == 0 && is_uploaded_file($file['tmp_name'])) {
            $moved = move_uploaded_file($file['tmp_name'], $name);
			
            if ($moved) {
                return $name;
            }
       // }

        return false;
    }

    // supprime un fichier présent sur le disque
    public static function remove($name, $dir = null)
    {
        $dir = $dir ? self::getImagePath($dir): self::getImagePath();
        if(!is_dir($dir)){
            throw new \Exception('repertoire non valide');
        }
        $name = $dir.D_S.$name;
        if(file_exists($name)) {
            unlink($name);
        } else {
            throw new \Exception('erreur fichier');
        }

    }

    // renvoi chemin ers  répertoire image
    public static function getImagePath($path ='')
    {
		$path = empty($path) ? $path : D_S.$path;
		
        return  ROOT.D_S.'gsb'.D_S.'img'.$path;
    }

    // lit un fichier csv
    public static function readCsv($file, $delim = ';')
    {
        $data = array();
        $file_handle = fopen($file, "r");
        while (!feof($file_handle) ) {
            $data[] = fgetcsv($file_handle, 1024, $delim);
        }
        fclose($file_handle);

        return $data;
    }

    // lit un fichier texte (inutilisé)
    public static function read($file)
    {
        $data = '';
        $fh = fopen($file['name'], "r");
        while (!feof($fh)) {
            $data.= fgetss($fh);
        }
        fclose($fh);

        return $data;
    }
} 