<?php
namespace Core\Toolbox\Converter;

/**
 * ToBool.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class ToBool extends AbstractConverter
{

    /**
     * Converts a value into boolean.
     *
     * Strings like '1', 'true', 'on', 'yes' or 'y' will converted into boolean true
     *
     * @return boolean
     */
    function convert(): bool
    {
        if (!is_string($this->value)) {
            $this->result = $this->value;
        }
        else {
            switch (strtolower($this->value)) {
                case '1':
                case 'true':
                case 'on':
                case 'yes':
                case 'y':
                    $this->result = true;
                default:
                    $this->result = false;
            }
        }

        return $this->result;
    }
}

