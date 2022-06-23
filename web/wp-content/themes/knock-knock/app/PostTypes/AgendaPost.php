<?php

namespace App\PostTypes;

use Timber\Post;

class AgendaPost extends Post {

    public function start() 
    {
        return strtotime(get_field('start', $this->ID));
    }

    public function end() 
    {
        return strtotime(get_field('einde', $this->ID));
    }

    /**
     * Returns author image
     */
    public function authorImage() 
    {
        return \App\getUserImage('thumbnail', $this->post_author);
    }

    /**
     * Returns author link
     */
    public function authorLink() 
    {
        return \App\userLink(get_user_by('ID', $this->post_author), true, false);
    }

    /**
     * Returns if item has passed
     */
    public function hasPassed() 
    {
        $start = get_field('start', $this->ID);
        return (date('Y-m-d', strtotime($start)) < date('Y-m-d'));
    }

    /**
     * Returns ISO date 
     */
    public function isoDate() 
    {
        return get_the_modified_date('c', $this->ID);
    }
}