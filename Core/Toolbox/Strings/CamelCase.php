<?php
namespace Core\Toolbox\Strings;

/**
 * CamelCase.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class CamelCase extends AbstractStrings
{
    /**
     * Converts strings with underscores into case sensitiv strings
     *
     * @param bool $upper_first
     *
     * @return string
     */
    function camelize(bool $upper_first = true): string
    {
        if (empty($this->string)) {
            Throw new \InvalidArgumentException('The string set to be camelized is empty.');
        }

        // even if there is no underscore in string, the first char will be converted to uppercase
        if (strpos($this->string, '_') == 0 && $upper_first == true) {
            $this->result = ucwords($this->string);
        }
        else {
            $this->result = str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower($this->string))));

            if ($upper_first == false) {
                $this->result = lcfirst($this->result);
            }
        }

        return $this->result;
    }

    /**
     * Converts camel case strings into underscored strings
     *
     * @throws InvalidArgumentException#
     *
     * @return string
     */
    function uncamelize(): string
    {
        if (empty($this->string)) {
            Throw new \InvalidArgumentException('The string set to be uncamelized is empty.');
        }

        $this->result = $this->string;
        $this->result[0] = strtolower($this->result[0]);

        $callback = function ($c) {
            return '_' . strtolower($c[1]);
        };

        $this->resultg = preg_replace_callback('/([A-Z])/', $callback, $this->result);
        $this->result = trim(preg_replace('@[_]{2,}@', '_', $this->result), '_');

        return $this->result;
    }
}
