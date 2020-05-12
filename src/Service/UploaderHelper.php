<?php

namespace App\Service;

use Gedmo\Sluggable\Util\Urlizer;
use League\Flysystem\FilesystemInterface;
use Symfony\Component\Asset\Context\RequestStackContext;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderHelper
{
    private $filesystem;
    private $requestStackContext;
    private $publicAssetBaseUrl;

    public function __construct(FilesystemInterface $publicUploadFilesystem, RequestStackContext $requestStackContext, string $uploadedAssetsBaseUrl)
    {
        $this->filesystem = $publicUploadFilesystem;
        $this->requestStackContext = $requestStackContext;
        $this->publicAssetBaseUrl = $uploadedAssetsBaseUrl;
    }

    public function getPublicPath(string $path): string
    {
        return $this->requestStackContext->getBasePath().$this->publicAssetBaseUrl.'/'.$path;
    }

    public function uploadImage(File $file): string
    {
        if ($file instanceof UploadedFile) {
            $originalFilename = $file->getClientOriginalName();
        } else {
            $originalFilename = $file->getFilename();
        }

        $newFilename = Urlizer::urlize(pathinfo($originalFilename, PATHINFO_FILENAME)).'-'.uniqid().'.'.$file->guessExtension();

        $stream = fopen($file->getPathname(), 'r');
        $result = $this->filesystem->writeStream(
      '/'.$newFilename,
      $stream
    );

        if (false === $result) {
            throw new \Exception(sprintf('Could not write upload file "%s" to filesystem', $newFilename));
        }

        // just making sure it's closed
        // appearently some implementations of flysystem don't auto close it
        if (is_resource($stream)) {
            fclose($stream);
        }

        return $newFilename;
    }
}
