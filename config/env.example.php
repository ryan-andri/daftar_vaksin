<?php
$configs = [
    'MAIN_HOST' => 'your website url',
    'DB_HOST' => 'localhost',
    'DB_USERNAME' => 'root',
    'DB_PASSWORD' => 'example',
    'DB_NAME' => 'example'
];

foreach ($configs as $con => $value) {
    putenv("$con=$value");
}
