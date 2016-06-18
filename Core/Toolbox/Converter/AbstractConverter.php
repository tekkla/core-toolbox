<?php
namespace Core\Toolbox\Converter;

/**
 * AbstractConverter.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
abstract class AbstractConverter
{

    /**
     *
     * @var mixed
     */
    protected $value;

    /**
     *
     * @var mixed
     */
    protected $result;

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

    /**
     * Returns conversion result
     *
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Resets/unsets result
     */
    public function resetResult()
    {
        unset($this->result);
    }
}

