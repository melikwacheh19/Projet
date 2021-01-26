<?php


namespace App\service;


use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(UploadedFile $file,String $path,$fileName)
    {
//        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
//        $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
//        originalFileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
        $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $fileName);
        $fileName = $safeFilename.'.'.$file->guessExtension();
//        $fullpath=$this->getTargetDirectory().$path.$fileName;
          $fullpath="uploads/".$path.$fileName;



        try {
            $file->move($this->getTargetDirectory()."/uploads/".$path, $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fullpath;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }

}