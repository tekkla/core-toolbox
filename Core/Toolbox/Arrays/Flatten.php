<?php
namespace Core\Toolbox\Arrays;

/**
 * Flatten.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class Flatten
{

    /**
     * Flattens a multidimensional array by using a glue
     *
     * @param array $array
     *            The array to flatten
     * @param string $glue
     *            Optional glue to get flattened array with this glue as return value
     * @param boolean $preserve_flagged_arrays
     *            With this optional flag and a set __preserve key in the array the array will be still flattended but
     *            also be stored as array with an ending .array key. Those arrays will not be flattened further more.
     *            This means any nesting array will stay arrays in this array.
     *
     * @return string|array
     */
    function flatten(array $array, $prefix = '', $glue = '.', $preserve_flagged_arrays = false)
    {
        $result = [];

        foreach ($array as $key => $value) {

            // Subarrray handling needed?
            if (is_array($value)) {

                // __preserve key set tha signals us to store the array as it is?
                if ($preserve_flagged_arrays && array_key_exists('__preserve', $value)) {
                    $result[$prefix . $key . $glue . 'array'] = $value;
                    unset($value['__preserve']);
                }

                // Flatten the array
                $result = $result + $this->flatten($value, $prefix . $key . $glue, $glue, $preserve_flagged_arrays);
            }
            else {
                $result[$prefix . $key] = $value;
            }
        }
        return $result;
    }
}

