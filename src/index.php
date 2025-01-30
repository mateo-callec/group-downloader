<?php

/**
 * @license MIT
 * @copyright 2025 Matéo Florian CALLEC
 * 
 * @version 1.0.1
 */



/**
 * Check if the group ID is provided as a command-line argument.
 */
if (isset($argv[1]) && is_int((int)$argv[1]))
{
    $group_id = $argv[1];
} else {
    print('No group ID provided.' . PHP_EOL);
}


/**
 * Check if the output file path is provided as a command-line argument.
 */
if (isset($argv[2]) && is_int((int)$argv[2]))
{
    $output_file_path = $argv[2];
} else {
    print('No output file path provided.' . PHP_EOL);
}


/**
 * Exit if required arguments are missing.
 */
if (!isset($group_id) || !isset($output_file_path))
{
    exit(0);
}


// Load required class files
require_once(__DIR__ . '/core/Api.php');


/**
 * @var Api $api Instance of the API class to fetch data.
 */
$api = new Api($group_id);


print('Downloading group data...' . PHP_EOL);

/**
 * @var array $users List of users retrieved from the API.
 */
$users = $api->get_users();

/**
 * @var array $posts List of wall posts retrieved from the API.
 */
$posts = $api->get_posts();

print('Done!' . PHP_EOL);

/**
 * Convert data to JSON format.
 * @var string $export JSON-encoded string containing users and posts.
 */
$export = json_encode(array(
    "users" => $users,
    "posts" => $posts
));

// Save data to file
file_put_contents($output_file_path, $export);

print('Output exported to "' . realpath($output_file_path) . '".' . PHP_EOL);


?>