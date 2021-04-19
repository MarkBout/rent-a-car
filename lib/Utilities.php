<?php


class Utilities
{
    function generateTemplate($templatePath, $data){
        $template = file_get_contents($templatePath);
        return preg_replace_callback('/{{(.+?)}}/', function($matches) use ($data) {return $data[$matches[1]];}, $template);
    }

    function redirect($url) {
        echo "<script> location.href='$url'; </script>";
        exit;
    }

    function getRole($role){
        switch ($role){
            case 0:
                $role = 'Klant';
                break;
            case 1:
                $role = 'Medewerker';
                break;
            default: $role = 'role could not be found Invalid integer';
        }
        return $role;
    }

}