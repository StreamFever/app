<?php

// src/Service/FileUploader.php
namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    private $targetDirectoryLogo;
    private $targetDirectoryMap;
    private $targetDirectoryAvatar;
    private $slugger;

    public function __construct($targetDirectoryLogo, $targetDirectoryMap, $targetDirectoryAvatar, SluggerInterface $slugger)
    {
        $this->targetDirectoryLogo = $targetDirectoryLogo;
        $this->targetDirectoryMap = $targetDirectoryMap;
        $this->targetDirectoryAvatar = $targetDirectoryAvatar;
        $this->slugger = $slugger;
    }

    public function uploadLogo(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->gettargetDirectoryLogo(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }

    public function uploadMap(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->gettargetDirectoryMap(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }

    public function uploadAvatar(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->gettargetDirectoryAvatar(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }

    public function gettargetDirectoryLogo()
    {
        return $this->targetDirectoryLogo;
    }

    public function gettargetDirectoryMap()
    {
        return $this->targetDirectoryMap;
    }

    public function gettargetDirectoryAvatar()
    {
        return $this->targetDirectoryAvatar;
    }
}