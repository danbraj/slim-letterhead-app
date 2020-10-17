<?php

namespace App\Application\Util;

use Psr\Http\Message\UploadedFileInterface;

class FileUploader
{
  public static function upload(UploadedFileInterface $uploadedFile)
  {
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
    $filename = sprintf('%s.%0.8s', $basename, $extension);

    $originalPath = UPLOAD_DIRECTORY . DIRECTORY_SEPARATOR . $filename;
    $thumbnailPath = THUMBNAIL_DIRECTORY . DIRECTORY_SEPARATOR . $filename;

    $uploadedFile->moveTo($originalPath);
    if ($extension == 'jpg' || $extension == 'png') {
      // Create thumbnail
      $desiredWidth = 400;
      $sourceImage = imagecreatefromjpeg($originalPath);
      $width = imagesx($sourceImage);
      $height = imagesy($sourceImage);
      // find the "desired height" of this thumbnail, relative to the desired width
      $desiredHeight = floor($height * ($desiredWidth / $width));
      // create a new, "virtual" image
      $virtualImage = imagecreatetruecolor($desiredWidth, $desiredHeight);
      // copy source image at a resized size
      imagecopyresampled($virtualImage, $sourceImage, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $width, $height);
      // create the physical thumbnail image to its destination
      imagejpeg($virtualImage, $thumbnailPath);
    }
    return $filename;
  }
};
