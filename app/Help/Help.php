<?php

namespace App\Help;


class Help
{
    const MAX_CHAR =  50;

    /**
     * Get sort description
     * @param text $desc
     * @param integer$max
     * @return string
     */
    public static function getSortDescription($desc, $max = Help::MAX_CHAR)
    {

        $desc = strip_tags($desc);
        $countWords = str_word_count($desc);
        $result = "";
        $small =  preg_split("/[\s,]+/ ", $desc);
        if ($countWords <= $max) {
            return $desc;
        }
        if ($max > count($small)) {
            $max = count($small);
        }
        for ($i = 0; $i < $max; $i++) {
            if (isset($small[$i])) {
                $result = $result . " " . $small[$i];
            }
        }
        return $result ."...";
    }

    /**
     * Get slug by title
     * @param string $str
     * @return string
     */
    public static function generateSlug($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        return preg_replace('/([\s]+)/', '-', $str);
    }

    public static function generateRandomString($length = 8) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
}

