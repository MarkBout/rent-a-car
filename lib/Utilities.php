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

    /**
     * @param $date1
     * @param $date2
     * @param string $interval what you want from the difference
     * days,months,years
     * @return float|int
     */
    function dateDifference( $date1 ,$date2,$interval = 'days')
    {
        $diff = abs(strtotime($date2) - strtotime($date1));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        switch ($interval){
            case 'days':
                return $days+1;
                break;
            case 'months':
                return $months;
                break;
                case 'years';
                return $years;
                break;
            default:return
                'interval not specified';
        }
    }
    function getPercentOfNumber($number, $percent){
        return ($percent / 100) * $number;
    }

}