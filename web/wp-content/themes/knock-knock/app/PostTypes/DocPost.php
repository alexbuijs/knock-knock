<?php

namespace App\PostTypes;

use Timber\Post;

class DocPost extends Post
{
    /**
     * Returns ISO date
     */
    public function isoDate()
    {
        return get_the_modified_date("c", $this->ID);
    }

    /**
     * Returns author image
     */
    public function authorImage()
    {
        $author_info = get_userdata($post->post_author);
        return App\getUserImage("thumbnail", $author_info->ID);
    }
}
