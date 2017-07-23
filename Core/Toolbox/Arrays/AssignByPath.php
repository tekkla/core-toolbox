<?php
namespace Core\Toolbox\Arrays;

/**
 * AssignByPath.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class AssignByPath
{

    /**
     * Creates an multidimensional array out of an string notation and adds a value to the last element.
     *
     * @param array $arr
     *            Reference to the array to fill
     * @param string $path
     *            Path to create array from
     * @param mixed $value
     *            The value to assign to the last key
     * @param string $separator
     *            Optional seperator to be used while splittint the path into key values (Default: '.')
     */
    function assign(array &$arr, string $path, $value, string $separator = '.')
    {
        $keys = explode($separator, $path);

        foreach ($keys as $key) {
            $arr = &$arr[$key];
        }

        $arr = $value;
    }
}

