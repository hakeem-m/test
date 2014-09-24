<?php
/*
 *@Description:  class that contains helper functions, can be used by various controllers.
 */
class Helper {
    
    /*
     * @Description: helper function that returns string between two characters.
     */
    public static function getStringBetween($str,$from,$to)
    {
        $sub = substr($str, strpos($str,$from)+strlen($from),strlen($str));
        return substr($sub,0,strpos($sub,$to));
    }
    
}