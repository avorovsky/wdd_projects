<?php

namespace Components;

/**
 * Resizes, coverts and saves image to directory
 */

class ImgToFile
{
  /**
   * Uploads image to folder_name
   * @param array $file
   * @param string $folder_name
   * @param integer $width
   * @param integer $height
   * @return string $name
   */
  public function uploadImgtoFile($file, $folder_name, $width, $height)
  {
    if($file['error'] == 1){
      // $image_name = "File exides the upload file.";
      return false;
    } else {
      $name = self::fileUpload($file, $folder_name, $width, $height);
      return $name;
    }
  }// end of uploadImgtoFile

  /**
   * check if you can upload image and then it uploads
   * @param array $file
   * @param string $folder_name
   * @param integer $width
   * @param integer $height
   * @return string $name
   */
  public static function fileUpload($file, $folder_name, $width, $height)
  {
    $msg = "";
    // directory where the file will go
    $target_dir =  DS.'var'.DS.'www'. IMG . $folder_name . DS;
    // clean the name for anything bad things
    $clean_name = preg_replace('/[^a-zA-Z0-9\'\s]/', "_", $file['name']);
    // height and width;
    $size = "_" . $width . "x" . $height;
    // randomly make string before image
    $random = substr(md5(uniqid(rand(), true)), 0, 5);
    // name of the picture
    $target_name = $random . "_" .$clean_name . $size . ".jpg";
    // twhat is the full final path and file name
    $target_file = $target_dir . $target_name;
    // checking the extension of the file
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // What is the mime type?
    $mime_type = strtolower(mime_content_type($file['tmp_name']));
    // array of allowed file size
    $allowed = ['image/jpeg', 'image/png', 'image/gif'];
    // checks stuff
    $uploadOk = 1;
    // if (mime type is NOT okay)
    if(!in_array($mime_type, $allowed)) {
      $msg = 'File is not an image.';
      $name = 0;
    }
    // check to see if an existing file exists with the same name
    if(file_exists($target_file)) {
      $msg = 'That file already exists.';
      $name = 0;
    }
    // Check file size
    if ($file["size"] > 1000000) {
      $msg = "File exides the upload file.";
      $name = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $msg = "Sorry, your file was not uploaded.";
        $name = 0;
    // if everything is ok, try to upload file
    } else {
      $image = self::resizeImage($file, $mime_type, $width, $height);
      // header('content-type: image/jpeg');
      file_put_contents($target_file , $image);
      $name = $target_name;
      $msg = "Image uploaded";
    }
    return $name;
  }

  /**
   * resuzes the image
   * @param array $file
   * @param string $folder_name
   * @param integer $width
   * @param integer $height
   * @return data $resized_image
   */
  public static function resizeImage($file, $image_mime, $width, $height)
  {
    switch ($image_mime) {
      case 'image/gif':
        $image = imagecreatefromgif($file['tmp_name']);
        $image = imagescale($image, $width);
        ob_start();
        imagegif($image);
        $resized_image = ob_get_contents();
        ob_end_clean();
        break;
      case 'image/jpeg':
        $image = imagecreatefromjpeg($file['tmp_name']);
        $image = imagescale($image, $width);
        ob_start();
        imagejpeg($image);
        $resized_image = ob_get_contents();
        ob_end_clean();
        break;
      case 'image/png':
        $image = imagecreatefrompng($file['tmp_name']);
        $image = imagescale($image, $width);
        ob_start();
        imagepng($image);
        $resized_image = ob_get_contents();
        ob_end_clean();
        break;
      default:
        return '';
    }
    return $resized_image;
  }
}
