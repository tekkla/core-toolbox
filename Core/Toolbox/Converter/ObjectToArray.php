<?php
namespace Core\Toolbox\Converter;

/**
 * ObjectToArray.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class ObjectToArray extends AbstractConverter
{

    /**
     * Converts the set object and it's public members recursively into an array.
     *
     * @return array
     */
    function convert(): array
    {
        if (!is_object($this->value)) {
            Throw new ConverterException('The given value is no object.');
        }

        return $this->result = $this->toArray($this->value);
    }

    /**
     *
     * @param object $obj
     *
     * @return array
     */
    private function toArray($obj): array
    {
        $out = [];

        foreach ($obj as $key => $val) {
            if (is_object($val)) {
                $out[$key] = $this->toArray($val);
            }
            else {
                $out[$key] = $val;
            }
        }

        return $out;
    }
}
