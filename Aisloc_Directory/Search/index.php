<?php

    
//Auth Token ya29.pABw7QYw2sTyZVqlnf_vgVnWpK_7uTZ9IGqlnvoYzhJIUdgZjIm-2nVmZHfw7Ummo994JGZdw-C7HQ
// 003216068209808291725:mm_3e1khx0e API ID
 // http://www.google.com/cse/api/003216068209808291725/cse/mm_3e1khx0e
    
    $html = file_get_contents("https://d1toine.aisloc.com/Aisloc_Directory/Search/gplus-quickstart-php/signin.php");
    
    preg_match_all(
                   '/access_token:\s(.*?)/',
                   $html,
                   $posts, // will contain the article data
                   PREG_SET_ORDER // formats data into an array of posts
                   );
    
    foreach ($posts as $post) {
        $auth = $post[0];
    }
    
    echo $auth;
    ?>
