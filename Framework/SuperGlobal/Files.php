<?php


namespace BK_Framework\SuperGlobal;


use BK_Framework\Logger\Logger;

class Files
{

    public static function saveImage($destination=null) : array {
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        $tmp_name = $_FILES['file']['tmp_name'];
        $directory = $destination ?? __DIR__ . "/../../Static/";
        $possibleTypes = ['gif','jpg','jpe','jpeg','png', 'image/jpeg'];

        if (in_array($fileType, $possibleTypes, true)) {
            move_uploaded_file($tmp_name, $directory.$fileName);
            return ['directory'=>$directory, 'fileName'=>$fileName];
        }
        return array();
    }
}