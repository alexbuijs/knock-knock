<?php

namespace App\Twig;

use App\Post;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use WP_post;

class Functions extends AbstractExtension
{
    public function getFunctions()
    {
        $functions = [
            new TwigFunction(
                "localDate",
                fn($format, $date) => date_i18n($format, $date),
            ),
            new TwigFunction(
                "userField",
                fn($field, $user) => get_field($field, $user),
            ),
            new TwigFunction(
                "permalink",
                fn(Post|WP_Post|int $post) => get_permalink($post),
            ),
            new TwigFunction("function", [&$this, "execFunction"]),
        ];

        return $functions;
    }

    /**
     * From https://github.com/timber/timber/blob/57fc582c42519f1b05fff5fb2ebf4291b5cd638f/lib/Twig.php#L290
     * @param string  $function_name
     * @return mixed
     */
    public function execFunction($function_name)
    {
        $args = func_get_args();
        array_shift($args);
        if (is_string($function_name)) {
            $function_name = trim($function_name);
        }
        return call_user_func_array($function_name, $args);
    }
}
