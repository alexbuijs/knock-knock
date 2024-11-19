<?php

namespace App;

use WP_Post;

class Post
{
    public function __construct(WP_Post $post = null)
    {
        if (!$post) {
            $post = get_post();
        }

        $this->import($post);
    }

    /**
     * Inspired by https://github.com/timber/timber/blob/57fc582c42519f1b05fff5fb2ebf4291b5cd638f/lib/Core.php#L59
     */
    private function import(WP_Post $post)
    {
        $properties = get_object_vars($post);

        foreach ($properties as $key => $value) {
            if ($key === "" || ord($key[0]) === 0) {
                continue;
            }

            if (!empty($key) && !method_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * Return a meta value
     */
    public function meta(string $key, $single = true)
    {
        if ($value = get_field($key, $this->ID)) {
            return $value;
        }

        return get_post_meta($this->ID, $key, $single);
    }
}
