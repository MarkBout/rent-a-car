<?php

$template = "I am {{name}}, and I work for {{company}}. I am {{age}}.";

# Your template tags + replacements
$replacements = array(
    'name' => 'Jeffrey',
    'company' => 'Envato',
    'age' => 27
);

function bind_to_template($replacements, $template) {
    return preg_replace_callback('/{{(.+?)}}/', function($matches) use ($replacements) {
        return $replacements[$matches[1]];
    }, $template);
}

// I am Jeffrey, and I work for Envato. I am 27.
echo bind_to_template($replacements, $template);