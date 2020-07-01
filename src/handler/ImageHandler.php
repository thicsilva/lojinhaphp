<?php

namespace App\Handler;

class ImageHandler
{

    public static function createImage($tmp_name, $type)
    {
        switch ($type) {
            case 'image/jpg':
            case 'image/jpeg':
                $o_img = imagecreatefromjpeg($tmp_name);
                break;
            case 'image/png':
                $o_img = imagecreatefrompng($tmp_name);
                break;
        }

        if (!empty($o_img)) {
            $width = 290;
            $height = 240;
            $ratio = $width / $height;

            list($o_width, $o_height) = getimagesize($tmp_name);

            $o_ratio = $o_width / $o_height;

            if ($ratio > $o_ratio) {
                $img_w = $height * $o_ratio;
                $img_h = $height;
            } else {
                $img_h = $width / $o_ratio;
                $img_w = $width;
            }

            if ($img_w < $width) {
                $img_w = $width;
                $img_h = $img_w / $o_ratio;
            }

            if ($img_h < $height) {
                $img_h = $height;
                $img_w = $img_h * $o_ratio;
            }

            $px = 0;
            $py = 0;

            if ($img_w > $width) {
                $px = ($img_w - $width) / 2;
            }

            if ($img_h > $height) {
                $py = ($img_h - $height) / 2;
            }

            $img = imagecreatetruecolor($width, $height);
            imagecopyresampled($img, $o_img, -$px, -$py, 0, 0, $img_w, $img_h, $o_width, $o_height);
            $imgName = md5(microtime() . rand(0, 9999));
            imagejpeg($img, dirname(__DIR__, 2) . '/public/assets/media/' . $imgName, 100);
            return $imgName;
        }

        return false;
    }
}
