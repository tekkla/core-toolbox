<?php
namespace Core\Toolbox\Date;

/**
 * Date.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class Date extends AbstractDate
{

    public function timeAgo($date, string $text = '')
    {
        $time = strtotime($date);
        $now = time();
        $ago = $now - $time;

        switch (true) {
            case ($ago < 60):
                $when = round($ago);
                $timestring = ($when == 1) ? "second" : "seconds";
                break;
            case ($ago < 3600):
                $when = round($ago / 60);
                $timestring = ($when == 1) ? "minute" : "minutes";
                break;
            case ($ago == 3600 && $ago < 86400):
                $when = round($ago / 60 / 60);
                $timestring = ($when == 1) ? "hour" : "hours";
                break;
            case ($ago == 86400 && $ago < 2629743.83):
                $when = round($ago / 60 / 60 / 24);
                $timestring = ($when == 1) ? "day" : "days";
                break;
            case ($ago == 2629743.83 && $ago < 31556926):
                $when = round($ago / 60 / 60 / 24 / 30.4375);
                $timestring = ($when == 1) ? 'month' : 'months';

                break;
            default:
                $when = round($ago / 60 / 60 / 24 / 365);
                $timestring = ($when == 1) ? 'year' : 'years';
                break;
        }

        return !empty($text) ? sprintf($text, $when, $timestring) : [
            $when,
            $timestring
        ];
    }
}

