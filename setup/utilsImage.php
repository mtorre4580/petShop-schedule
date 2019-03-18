<?php

    /**
     * Permite crear el nombre de la imagen, con la extensión
     * @param Array $pic
     * @param string $name
     * @return string
     */
    function createNameImage($pic, $name) {
        $ext = pathinfo($pic['name'], PATHINFO_EXTENSION);
        $newName = preg_replace(REGEX_PIC_SPACES, '-', trim($name));
        $nameNormalize = preg_replace(REGEX_MULTIPLE_SPACES, '-', $newName);
        return $nameNormalize.".$ext";
    }

    /**
     * Permite guardar la imagen en la carpeta uploads...
     * @param Array $pic
     * @param string $fileName
     * @param string $path
     * @return void
     */
    function savePic($pic, $fileName, $path) {
        $tmpFile = $pic['tmp_name']; 
        $extension = pathinfo($pic['name'], PATHINFO_EXTENSION);
        $original = createImageFrom($extension, $tmpFile);
        $widthOriginal = imagesx($original);
        $heightOriginal = imagesy($original);
        $width = 600;
        $height = round($width * $heightOriginal / $widthOriginal);
        $copy = imagecreatetruecolor($width,$height);//FIXME, CAMBIAR 0,0,0,0...
        imagecopyresampled($copy, $original, 0, 0, 0, 0, $width, $height, $widthOriginal, $heightOriginal);
        createImage($extension, $fileName, $copy, $path);
        imagedestroy($copy);
        imagedestroy($original);
    }

    /**
     * Permite crear la imagen de acuerdo al mimetype...
     * @param string $ext
     * @param string $tmpFile
     * @return string
     */
    function createImageFrom($ext, $tmpFile) {
        if (preg_match(REGEX_JPG_JPEG, $ext)) {
            return imagecreatefromjpeg($tmpFile);
        }
        if (preg_match(REGEX_PNG, $ext)) {
            return imagecreatefrompng($tmpFile);
        }
    }  

    /**
     * Permite crear la imagen
     * @param string $ext
     * @param string $fileName
     * @param string $copy
     * @param string $path
     * @return void
     */
    function createImage($ext, $fileName, $copy, $path) {
        if (preg_match(REGEX_JPG_JPEG, $ext)) {
            imagejpeg($copy, "$path/$fileName", 0);
        }
        if (preg_match(REGEX_PNG, $ext)) {
            imagepng($copy, "$path/$fileName", 0);
        }
    }
    
?>