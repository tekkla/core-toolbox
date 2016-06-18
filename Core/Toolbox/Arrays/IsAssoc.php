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
     *
     * @var array
     */
    private $array;

    /**
     * Constructor
     *
     * @param array $array
     *            The array to prove
     */
    public function __construct(array $array)
    {
        $this->setArray($array);
    }

    /**
     * Sets the array to prove
     *
     * @param array $array
     */
    public function setArray(array $array)
    {
        $this->array = $array;
    }

    /**
     * Checks a value whether to be an array, if its empty and when not an empty array if it's an associative one.
     *
     * @return bool
     */
    function prove(): bool
    {
        if (empty($this->array)) {
            return false;
        }

        return (bool) count(array_filter(array_keys($this->array), 'is_string'));
    }
}

