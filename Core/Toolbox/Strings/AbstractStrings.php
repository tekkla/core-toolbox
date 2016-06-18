<?php
namespace Core\Toolbox\Strings;

/**
 * AbstractStrings.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
abstract class AbstractStrings
{

    /**
     *
     * @var string
     */
    protected $string = '';

    /**
     *
     * @var string
     */
    protected $result = '';

    /**
     * Constructor
     *
     * @param string $string
     */
    public function __construct(string $string)
    {
        $this->setString($string);
    }

    /**
     * Sets the string to change
     *
     * @param string $string
     */
    public function setString(string $string)
    {
        $this->string = $string;
    }

    /**
     * Returns the result
     *
     * @return string
     */
    public function getResult(): string
    {
        return $this->result;
    }
}

