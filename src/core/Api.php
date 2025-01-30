<?php

/**
 * @license MIT
 * @copyright 2025 Matéo Florian CALLEC
 * 
 * @version 1.2.0
 */



/**
 * Class Api
 * 
 * This class provides methods to retrieve user lists and wall posts
 * from a given Roblox group using their public API.
 */
class Api
{
    /**
     * @var string API URL for version 1 requests.
     */
    private $api_url_v1;


    /**
     * @var string API URL for version 2 requests.
     */
    private $api_url_v2;


    /**
     * Constructor to initialize API URLs.
     *
     * @param string $group_id The group ID for fetching data.
     */
    public function __construct(string $group_id)
    {
        $this->api_url_v1 = "https://groups.roblox.com/v1/groups/$group_id/";
        $this->api_url_v2 = "https://groups.roblox.com/v2/groups/$group_id/";
    }


    /**
     * Retrieve the list of users in the group.
     *
     * @return array List of users.
     */
    public function get_users()
    {
        $url_template = $this->api_url_v1 . 'users?sortOrder=Asc&limit=100';
        
        $users = [];

        $next_page_cursor = null;

        do {
            if ($next_page_cursor !== null)
            {
                // Update URL
                
                $url = "$url_template&cursor=$next_page_cursor";

                sleep(2);
            } else {
                $url = $url_template;
            }

            $content = $this->get_remote_contents($url);
            $data = json_decode($content, true);
            
            foreach ($data['data'] as $user)
            {
                array_push($users, $user);
            }

            $next_page_cursor = $data['nextPageCursor'];
        } while ($next_page_cursor !== null);

        return $users;
    }


    /**
     * Retrieve the list of posts from the group's wall.
     *
     * @return array List of posts.
     */
    public function get_posts()
    {
        $url_template = $this->api_url_v2 . 'wall/posts?sortOrder=Asc&limit=100';

        $posts = [];

        $next_page_cursor = null;

        do {
            if ($next_page_cursor !== null)
            {
                // Update URL
                
                $url = "$url_template&cursor=$next_page_cursor";
            } else {
                $url = $url_template;
            }

            sleep(2);

            $content = $this->get_remote_contents($url);
            $data = json_decode($content, true);
            
            foreach ($data['data'] as $post)
            {
                array_push($posts, $post);
            }

            $next_page_cursor = $data['nextPageCursor'];
        } while ($next_page_cursor !== null);

        return $posts;
    }


    /**
     * Fetch remote content from a given URL with retry logic.
     *
     * @param string $url The URL to fetch.
     * @return string The response content.
     */
    public function get_remote_contents(string $url): string
    {
        $need_sleep = false;

        do
        {
            $response = file_get_contents($url);
            
            if ($need_sleep === true)
            {
                /**
                 * If the response fails, retry in 10 seconds.
                 */
                print('Waiting...' . PHP_EOL);

                sleep(10);
            }

            $need_sleep = true;
        } while($response === false);

        return $response;
    }
}


// Example usage:
//$crawler = new Api(123456789); // Replace with a valid Roblox group ID
//$users = $api->get_users();
//print_r($users);
//$posts = $api->get_posts();
//print_r($posts);


?>