<?php

namespace App\PostTypes;

use Timber\Post;

class AgendaPost extends Post
{
    public function start()
    {
        return strtotime(get_field("start", $this->ID));
    }

    public function end()
    {
        return strtotime(get_field("einde", $this->ID));
    }

    /**
     * Return type of agenda item
     */
    public function type()
    {
        $type = get_field("type", $this->ID);

        // Deprecated options since 20-1-2025, fallback here
        if ($type === "pr-openbaar") {
            return "Reservering 't Klophuis - Openbaar";
        }

        return $type;
    }

    /**
     * Returns author image
     */
    public function authorImage()
    {
        return \App\getUserImage("thumbnail", $this->post_author);
    }

    /**
     * Returns author link
     */
    public function authorLink()
    {
        return \App\userLink(
            get_user_by("ID", $this->post_author),
            true,
            false,
        );
    }

    /**
     * Returns if item has passed
     */
    public function hasPassed()
    {
        $start = get_field("start", $this->ID);
        return date("Y-m-d", strtotime($start)) < date("Y-m-d");
    }

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
