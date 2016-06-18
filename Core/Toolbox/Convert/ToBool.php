<?php
namespace Core\Toolbox\Convert;

/**
 * ToBool.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class ToBool extends AbstractConvert
{
    /**
     * Converts a value into boolean
     *
     * @return boolean
     */
    function convert(): bool
    {
        if (!is_string($this->value)) {
            return (bool) $this->value;
        }

        switch (strtolower($this->value)) {
            case '1':
            case 'true':
            case 'on':
            case 'yes':
            case 'y':
                return true;
            default:
                return false;
        }
    }
}

