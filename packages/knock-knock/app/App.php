<?php

namespace App;

use App\Twig\Twig;
use App\Classes\ViteAssetVersionStrategy;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Asset\Package;

class App
{
    private static ContainerBuilder $container;

    protected function __construct()
    {
    }

    public static function init()
    {
        // Class alias so we can use App::render() instead of App\App::render()
        class_alias("App\App", "App");

        $container = new ContainerBuilder();

        $container->register("filters", Filters::class);
        $container->register("twig", Twig::class);
        $container
            ->register("asset", Package::class)
            ->addArgument(
                new ViteAssetVersionStrategy(
                    dirname(__DIR__) . "/dist/.vite/manifest.json",
                ),
            );

        add_action("app/twig", [self::class, "twigInit"]);

        self::$container = $container;
    }

    public static function twigInit($twig)
    {
        // Add globally available context
        $menuId = get_nav_menu_locations()["menu"] ?? false;
        $menu = wp_get_nav_menu_items($menuId);
        _wp_menu_item_classes_by_context($menu);

        $twig->addGlobal("menu", $menu);
        $twig->addGlobal("theme_uri", dirname(get_template_directory_uri()));
        $twig->addGlobal("options", get_fields("option"));
        $twig->addGlobal("current_user", get_userdata(get_current_user_id()));
        $twig->addGlobal("current_user_thumbnail", getUserImage());
        $twig->addGlobal("site", ["url" => get_bloginfo("url")]);
    }

    /**
     * Alias for Twig's render function
     */
    public static function render(...$args)
    {
        $twig = self::$container->get("twig")->twig;
        echo $twig->render(...$args);
    }

    public static function asset($assetName)
    {
        $uriBase = dirname(get_template_directory_uri()) . "/dist/";
        return $uriBase . self::$container->get("asset")->getUrl($assetName);
    }

    public static function getPosts($args, $Class = Post::class)
    {
        $posts = array_map(fn($post) => new $Class($post), get_posts($args));

        return $posts;
    }
}
