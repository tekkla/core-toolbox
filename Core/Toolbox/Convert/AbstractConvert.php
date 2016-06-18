<?php
namespace Core\Toolbox\Convert;

/**
 * AbstractConvert.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
abstract class AbstractConvert
{

    /**
     *
     * @var mixed
     */
    protected $value;

    /**
     * Constructor
     *
     * @param mixed $value
     *            The value to convert
     */
    public function __construct($value)
    {
        $this->setValue($value);
    }

    /**
     * Sets value
     *
     * @param mixed $value
     *            The value to convert
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Returns value
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}

