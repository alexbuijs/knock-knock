<?php

namespace App\PostTypes;

use Timber\Post;

class HousePost extends Post
{
    /**
     * Get residents who live in this house
     */
    public function residents()
    {
        $residents = fetch()->usersByHouse($this->ID);

        foreach ($residents as $user) {
            $user->thumbnail = \App\getUserImage("thumbnail", $user->ID);
            $user->image = \App\getUserImage("medium", $user->ID);
            $user->url = \App\userLink($user);
        }

        return $residents;
    }
}
