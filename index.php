<?php
$file = __DIR__ . '/templates/row-template.php';

$rows = array(
    array('id' => 1, 'name' => 'first row', 'etc' => 'and more...'),
    array('id' => 2, 'name' => 'second row', 'etc' => 'nothing special'),
);

$output = '';

foreach ($rows as $row) {
    $output .= template($file, $row);
}

print $output;

$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
fwrite($myfile, $output);
fclose($myfile);


function template($file, $args)
{
    // ensure the file exists
    if (!file_exists($file)) {
        return '';
    }

    // Make values in the associative array easier to access by extracting them
    if (is_array($args)) {
        extract($args);
    }

    // buffer the output (including the file is "output")
    ob_start();
    include $file;
    return ob_get_clean();
}


//https://www.daggerhartlab.com/create-simple-php-templating-function/