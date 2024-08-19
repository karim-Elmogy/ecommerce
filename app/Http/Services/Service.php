<?php

namespace App\Http\Services;
class Service
{
    public function upload($file , $folder){
        $fileNameWithoutSpaces = str_replace(' ','_',$file->getClientOriginalName());
        $editedFileName = time().'_'.$fileNameWithoutSpaces;
        $file->move($folder, $editedFileName);
        return $editedFileName;
    }
}
