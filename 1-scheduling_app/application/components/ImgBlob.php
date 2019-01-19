<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * actions to write/retrive image to/ from DB
 */

namespace Components;

class ImgBlob
{
    
    /*
     * resizes img-files, returns binary
     *
     * @param object - file to resize
     * @param string - mime type of file
     * @param int - width requred
     * @return string
     */
    private static function resizeImage($file, $image_mime, $width)
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
    
    /*
     * returns array with Blob (mime and binary) from img-file
     *
     * @param object - file to convert
     * @param int - width requred (optional)
     * @param int - height requred (optional)
     * @return array
     */
    public static function fileToBlob($file, $width=200, $height=0)
    {

        if (!$file['tmp_name']) {
            return false;
        }

        if ($height) {
            // hieght is sent - preserve ratio using height
            $imageSize = getimagesize($file['tmp_name']);
            if ($imageSize[1]) {
                // prevent divide by zero
                $ratio = $height/$imageSize[1];
                $width = $imageSize[0]*$ratio;
            }
        }

        $image_mime = (empty($file['type']) ? '' : $file['type']);

        $image = self::resizeImage($file, $image_mime, $width);
        
        return array(
            'image_mime' => $image_mime,
            'image' => $image,
            );
        
    }
    
    /*
     * returns img-html from mime and binary
     *
     * @param string - mime type name
     * @param string - binary data of image
     * @return string - image to display or deault img src
     */
    public static function blobToSrc($image_mime, $image)
    {

        if (!empty($image_mime) && !empty($image)) {
            return 'data:'.$image_mime.';base64,'.base64_encode($image);
        }
        return IMG.'no_image_available.png';
    }

    /*
     * outputs image to browser (DOES NOT WORK)
     *
     * @param string - mime type name
     * @param string - binary data of image
     */
    public static function blobToEcho($image_mime, $image)
    {
        if (!empty($image_mime) && !empty($image)) {
            header('Content-type: '.$image_mime);
            switch ($image_mime) {
                case 'image/gif':
                    imagegif($image);
                    break;
                case 'image/jpeg':
                    imagejpeg($image);
                    break;
                case 'image/png':
                    imagepng($image);
                    break;
                default:
                    break;
            }
        }
    }

}
