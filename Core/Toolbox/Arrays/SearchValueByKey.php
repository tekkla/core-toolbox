<?php
namespace Core\Toolbox\Arrays;

/**
 * SearchValueByKey.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class SearchValueByKey
{

    /**
     * Searches an $array recursively for the $key and returns all matching values as array
     *
     * @param array $array
     *            Array to search in
     * @param string $key
     *            The key compare
     * @param string $search
     *            The value to search for in key
     *
     * @return array
     */
    function search(array $array, string $key, string $search): array
    {
        $it = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($array));

        $out = [];

        foreach ($it as $sub) {

            $sub_array = $it->getSubIterator();

            if ($sub_array[$key] === $search) {
                $out[] = iterator_to_array($sub_array);
            }
        }

        return $out;
    }
}

