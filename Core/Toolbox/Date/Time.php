<?php
namespace Core\DateTime;

/**
 * Time.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016-2017
 * @license MIT
 */
class Time
{

    const SEC_PER_DAY = 60 * 60 * 24;

    const SEC_PER_HOUR = 60 * 60;

    /**
     * Converts a date and time string into timestamp
     *
     * @param string $date
     * @param string $time
     *
     * @return number
     */
    public function toTimestamp(string $date, string $time = ''): int
    {
        if (empty($time)) {
            $time = '00:00:01';
        }
        
        // create unix_timestamp
        return strtotime($date . ' ' . $time);
    }

    /**
     * Converts a timestamp into many date infos
     *
     * @param int $timestamp
     *            The timestamp to convert
     * @param string $dateformat
     *            The dateformat (Default: 'Y-m-d')
     * @param string $timeformat
     *            The timeformat (Default: 'H:i')
     *            
     * @return array
     */
    public function fromTimestamp(int $timestamp, string $dateformat = 'Y-m-d', string $timeformat = 'H:i'): array
    {
        return [
            'stamp' => $timestamp,
            'date' => date($dateformat, $timestamp),
            'time' => date($timeformat, $timestamp),
            'week' => date('W', $timestamp),
            'day' => date('d', $timestamp),
            'month' => date('m', $timestamp),
            'hour' => date('H', $timestamp),
            'minute' => date('i', $timestamp)
        ];
    }

    /**
     * Converts a date into another format
     *
     * @param string $date
     * @param string $format
     *
     * @return string
     */
    public function dateConversion(string $date, string $format = 'Y-m-d'): string
    {
        return date($format, strtotime($date));
    }

    /**
     * Calculates time left from an timestamp in the future
     *
     * @param int $timestamp
     * @param bool $left
     *
     * @return string
     */
    public function timeLeft(int $timestamp, bool $Left = true): string
    {
        $diff = $bLeft == true ? time() - $timestamp : $timestamp;
        
        $showdiff = [
            "y" => 0,
            "m" => 0,
            "w" => 0,
            "d" => 0,
            "h" => 0,
            "min" => 0
        ];
        
        while ($diff >= 31536000) {
            // 1 year = 31536000 seconds
            $diff -= 31536000;
            $showdiff['y'] ++;
        }
        while ($diff >= 2419200) {
            // 1 day = 2592000 seconds
            $diff -= 2419200;
            $showdiff['m'] ++;
        }
        while ($diff >= 648000) {
            // 1 week = 604800 seconds
            $diff -= 648000;
            $showdiff['w'] ++;
        }
        
        while ($diff >= 86400) {
            // 1 day = 86400 seconds
            $diff -= 86400;
            $showdiff['d'] ++;
        }
        
        while ($diff >= 3600) {
            // 1 hour = 3600 seconds
            $diff -= 3600;
            $showdiff['h'] ++;
        }
        
        while ($diff >= 60) {
            // 1 minute = 60 seconds
            $diff -= 60;
            $showdiff['min'] ++;
        }
        
        return $showdiff;
    }
}
