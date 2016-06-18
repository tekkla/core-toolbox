<?php
namespace Core\Toolbox\Arrays;

/**
 * AbstractArray.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
abstract class AbstractArray
{

    /**
     *
     * @var array
     */
    protected $array;

    /**
     * Constructor
     *
     * @param mixed $array
     */
    public function __construct(array $array)
    {
        $this->setValue($array);
    }

    /**
     * Sets array
     *
     * @param array $array
     */
    public function setValue(array $array)
    {
        $this->array = $array;
    }

    /**
     * Returns array
     *
     * @return array
     */
    public function getValue()
    {
        return $this->array;
    }
}

