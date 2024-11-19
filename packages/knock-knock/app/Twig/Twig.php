<?php

namespace App\Twig;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\Extension\EscaperExtension;

class Twig
{
    public Environment $twig;

    public function __construct()
    {
        $themeRoot = dirname(get_stylesheet_directory());

        $loader = new FilesystemLoader($themeRoot . "/views");

        $twig = new Environment($loader, [
            "cache" => $themeRoot . "/.twig-cache",
            "auto_reload" => true,
        ]);

        $twig->addExtension(new Filters());
        $twig->addExtension(new Functions());

        $twig
            ->getExtension(EscaperExtension::class)
            ->setEscaper(
                "esc_html",
                fn(Environment $env, $string) => wp_kses_post($string),
            );

        do_action("app/twig", $twig);

        $this->twig = $twig;
    }
}
