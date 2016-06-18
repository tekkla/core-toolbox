<?php
namespace Core\Toolbox\Arrays;

/**
 * InsertArrayAfter.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class InsertArrayAfter
{

    /**
     * Inserts an array ($insert) at ($position) after the key ($search) in an array ($array) and returns a combined
     * array
     *
     * @param array $array
     *            Array to insert the array
     * @param array $insert
     *            Array to insert inti $array
     * @param string $search
     *            Key to search and insert after
     * @param number $position
     *            Position after the found key to insert into
     *
     * @throws InvalidArgumentException
     *
     * @return array
     */
    function insert(&$array, $search, $insert, $position = 0)
    {
        if (!is_array($array)) {
            throw new \Exception('Wrong parameter type.', 1000);
        }

        $counter = 0;
        $keylist = array_keys($array);

        foreach ($keylist as $key) {
            if ($key == $search) {
                break;
            }
            $counter++;
        }

        $counter += $position;

        $array = array_slice($array, 0, $counter, true) + $insert + array_slice($array, $counter, null, true);

        return $array;
    }
}

