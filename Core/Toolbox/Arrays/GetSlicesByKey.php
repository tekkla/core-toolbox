<?php
namespace Core\Toolbox\Arrays;

/**
 * GetSlicesByKey.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class GetSlicesByKey
{

    /**
     * Slices an array at the search point and returns both slices.
     *
     * @param array $array
     * @param string $search
     * @param integer $position
     *
     * @throws InvalidArgumentException
     *
     * @return array
     */
    function slice(array $array, string $search, int $position = 0): array
    {
        if (!is_array($array)) {
            throw new \InvalidArgumentException('Wrong parameter type.');
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

        return [
            array_slice($array, 0, $counter, true),
            array_slice($array, $counter, null, true)
        ];
    }
}

