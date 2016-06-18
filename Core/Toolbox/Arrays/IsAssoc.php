<?php
namespace Core\Toolbox\Arrays;

/**
 * IsAssoc.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class IsAssoc
{

    /**
     * Checks a value whether to be an array, if its empty and when not an empty array if it's an associative one.
     *
     * @return bool
     */
    function isAssoc(): bool
    {
        if (empty($this->array)) {
            return false;
        }

        return (bool) count(array_filter(array_keys($this->array), 'is_string'));
    }
}

