<?php

namespace App\PostTypes;

use Timber\Post;

class EventPost extends Post
{
    /**
     * Returns ISO date
     */
    public function isoDate()
    {
        return get_the_modified_date("c", $this->ID);
    }

    /**
     * Return if post is newly made or edited
     */
    public function isNew()
    {
        return get_the_modified_date("c", $this->ID) ==
            get_the_date("c", $this->ID);
    }
}
