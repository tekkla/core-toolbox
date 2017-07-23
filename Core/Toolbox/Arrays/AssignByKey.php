<?php
namespace Core\Toolbox\Arrays;

/**
 * AssignByKey.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class AssignByKey extends AbstractArray
{

    /**
     * Creates an multidimensional array out of an array with keynames
     *
     * @param array $keys
     *            The array holding the keys to use as values
     * @param mixed $value
     *            The value to assign to the last key
     */
    function assign(array $keys, $value)
    {
        foreach ($keys as $key) {
            $arr = &$this->array[$key];
        }

        $arr = $value;

        return $this->array;
    }
}

