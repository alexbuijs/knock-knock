<?php

namespace App\Classes;

use App\PostTypes\AgendaPost;

class Calendar
{
    /**
     * Calendar constructor
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function getLinks(AgendaPost $post)
    {
        $links = [];

        $links["google"] = self::getGoogleLink($post);
        $links["outlook"] = self::getOutlookLink($post);
        $links["office365"] = self::getOffice365Link($post);
        $links["ics"] = self::getICS($post);

        return $links;
    }

    /**
     * Based on https://github.com/InteractionDesignFoundation/add-event-to-calendar-docs/blob/6876fa98a1b517ffb680e5448176c05f7622e2e6/services/google.md
     */
    private function getGoogleLink(AgendaPost $post)
    {
        $url = add_query_arg(
            [
                "action" => "TEMPLATE",
                "dates" =>
                    self::formatDate("google", $post->start()) .
                    "/" .
                    self::formatDate("google", $post->end()),
                "ctz" => "Europe/Amsterdam",
                "text" => rawurlencode($post->title),
                "location" => rawurlencode(get_field("type", $post->ID)),
            ],
            "https://calendar.google.com/calendar/render",
        );

        return $url;
    }

    /**
     * Based on https://github.com/InteractionDesignFoundation/add-event-to-calendar-docs/blob/6876fa98a1b517ffb680e5448176c05f7622e2e6/services/outlook-web.md
     */
    private function getMicrosoftLink(AgendaPost $post, $baseUrl)
    {
        $url = add_query_arg(
            [
                "path" => rawurlencode("calendar/action/compose"),
                "rru" => "addevent",
                "subject" => rawurlencode($post->title),
                "startdt" => self::formatDate("ms", $post->start()),
                "enddt" => self::formatDate("ms", $post->end()),
                "location" => rawurlencode(get_field("type", $post->ID)),
                "ctz" => "Europe/Amsterdam",
            ],
            $baseUrl . "/calendar/0/deeplink/compose",
        );

        return $url;
    }

    private function getOutlookLink(AgendaPost $post)
    {
        return self::getMicrosoftLink($post, "https://outlook.live.com");
    }

    private function getOffice365Link(AgendaPost $post)
    {
        return self::getMicrosoftLink($post, "https://outlook.office.com");
    }

    private function getICS(AgendaPost $post)
    {
        $start = self::formatDate("ics", $post->start());
        $end = self::formatDate("ics", $post->end());
        $location = get_field("type", $post->ID);

        $data = <<<EOT
        BEGIN:VCALENDAR
        VERSION:2.0
        BEGIN:VEVENT
        DTSTART:$start
        DTEND:$end
        SUMMARY:$post->title
        LOCATION:$location
        END:VEVENT
        END:VCALENDAR
        EOT;

        return "data:text/calendar;charset=utf8," . rawurlencode($data);
    }

    private function formatDate($type, $timestamp)
    {
        switch ($type) {
            case "google":
            case "ics":
                return date("omd\THis", $timestamp);
            case "ms":
                return rawurlencode(date("o-m-d\TH:i:s", $timestamp));
        }
    }
}
