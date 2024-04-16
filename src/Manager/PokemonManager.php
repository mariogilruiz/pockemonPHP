<?php

namespace App\Manager;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class PokemonManager
{
    public function uploadImage(UploadedFile $image, $targetPath)
    {
        $filename = uniqid().".".$image->guessExtension();

        try {
            $image->move($targetPath, $filename);
        } catch (\Exception $e){

        }

        return $filename;
    }
}
