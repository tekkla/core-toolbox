<?php
namespace Core\Toolbox\Arrays;

/**
 * AssignByKey.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class AssignByKey
{

    /**
     * Creates an multidimensional array out of an array with keynames
     *
     * @param array $arr
     *            Reference to the array to fill
     * @param array $keys
     *            The array holding the keys to use as values
     * @param mixed $value
     *            The value to assign to the last key
     */
    function assign(array &$arr, array $keys, $value)
    {
        foreach ($keys as $key) {
            $arr = &$arr[$key];
        }

        $arr = $value;
    }
}

