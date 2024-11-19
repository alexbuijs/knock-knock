<?php

namespace App\Twig;

use Carbon\Carbon;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class Filters extends AbstractExtension
{
    public function getFilters()
    {
        $filters = [
            new TwigFilter("sanitizeTitle", fn($str) => sanitize_title($str)),
            new TwigFilter(
                "timeDiff",
                fn($isoTime) => self::timeDiff($isoTime),
            ),
            new TwigFilter(
                "timeDiffShort",
                fn($isoTime) => self::timeDiff($isoTime, true),
            ),
            new TwigFilter(
                "localMonth",
                fn($month) => date_i18n(
                    "F",
                    strtotime(date("Y") . "-" . $month),
                ),
            ),
            new TwigFilter("esc_html", fn($html) => esc_html($html)),
        ];

        return $filters;
    }

    /**
     * Change time into diff format (e.g. n minutes ago)
     */
    private static function timeDiff($date, $short = false)
    {
        return Carbon::parse($date)
            ->locale("nl_NL")
            ->diffForHumans([
                "short" => $short,
            ]);
    }
}
