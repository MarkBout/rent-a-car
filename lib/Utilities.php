<?php


class Utilities
{
    function generateTemplate($templatePath, $data){
        $template = file_get_contents($templatePath);
        return preg_replace_callback('/{{(.+?)}}/', function($matches) use ($data) {return $data[$matches[1]];}, $template);
    }
}