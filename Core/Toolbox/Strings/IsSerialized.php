<?php
namespace Core\Toolbox\Strings;

/**
 * IsSerialized.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class IsSerialized extends AbstractStrings
{

    private $result;

    /**
     * Sets a reference to a result var which will be used to store the unserialized result when string is serialized
     *
     * @param mixed $result
     */
    public function setResult(&$result)
    {
        $this->result = $result;
    }


    /**
     * Tests if an input is valid PHP serialized string
     *
     * Checks if a string is serialized using quick string manipulation
     * to throw out obviously incorrect strings. Unserialize is then run
     * on the string to perform the final verification.
     *
     * Valid serialized forms are the following:
     * <ul>
     * <li>boolean: <code>b:1;</code></li>
     * <li>integer: <code>i:1;</code></li>
     * <li>double: <code>d:0.2;</code></li>
     * <li>string: <code>s:4:"test";</code></li>
     * <li>array: <code>a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}</code></li>
     * <li>object: <code>O:8:"stdClass":0:{}</code></li>
     * <li>null: <code>N;</code></li>
     * </ul>
     *
     * @return boolean if $value is serialized data, otherwise false
     */
    function isSerialized(): bool
    {
        // Empty strings cannot get unserialized
        if (strlen($this->string) <= 1) {
            return false;
        }

        // Serialized false, return true. unserialize() returns false on an
        // invalid string or it could return false if the string is serialized
        // false, eliminate that possibility.
        if ($this->string === 'b:0;') {
            $result = false;
            return true;
        }

        $length = strlen($this->string);
        $end = '';

        switch ($this->string[0]) {
            case 's':
                if ($this->string[$length - 2] !== '"') {
                    return false;
                }
            case 'b':
            case 'i':
            case 'd':
                $end .= ';';
            case 'a':
            case 'O':
                $end .= '}';

                if ($this->string[1] !== ':') {
                    return false;
                }

                switch ($this->string[2]) {
                    case 0:
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                    case 5:
                    case 6:
                    case 7:
                    case 8:
                    case 9:
                        break;

                    default:
                        return false;
                }
            case 'N':
                $end .= ';';

                if ($this->string[$length - 1] !== $end[0]) {
                    return false;
                }

                break;

            default:
                return false;
        }

        if (($this->result = @unserialize($this->string)) === false) {
            $this->result = null;
            return false;
        }

        return true;
    }
}

