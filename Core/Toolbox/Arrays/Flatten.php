<?php
namespace Core\Toolbox\Arrays;

/**
 * Flatten.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class Flatten extends AbstractArray
{

    /**
     *
     * @var bool
     */
    private $glue = '.';

    /**
     *
     * @var bool
     */
    private $preserve_flagged_arrays = false;

    /**
     * Sets glue
     *
     * @param string $glue
     */
    public function setGlue(string $glue)
    {
        $allowed_glues = [
            '.',
            '_',
            '-'
        ];

        if (!in_array($glue, $allowed_glues)) {
            Throw new ArraysException('This glues "%s" is not permitted. Allowed glues are "%s"', $glue, implode(', ', $allowed_glues));
        }

        $this->glue = $glue;
    }

    /**
     * Retuns glue
     *
     * @return string
     */
    public function getGlue(): string
    {
        return $this->glue;
    }

    /**
     * Sets preserve flagged arrays Flag
     *
     * @param bool $flag
     */
    public function setPreserveFlaggedArraysFlag(bool $flag)
    {
        $this->preserve_flagged_arrays = $flag;
    }

    /**
     * Returns preserve flagged arrays Flag
     *
     * @return bool
     */
    public function getPreserveFlaggedArraysFlag(): bool
    {
        return $this->preserve_flagged_arrays;
    }

    /**
     * Flattens a multidimensional array by using the set glue
     *
     * @param string $prefix
     *            Optional prefix to prepend to flattened keys
     */
    public function flatten(string $prefix = '')
    {
        return $this->flatten($this->array, $prefix);
    }

    /**
     * Flattens a multidimensional array by using a glue
     *
     * @param array $array
     *            The array to flatten
     * @param string $glue
     *            Optional glue to get flattened array with this glue as return value
     * @param boolean $preserve_flagged_arrays
     *            With this optional flag and a set __preserve key in the array the array will be still flattended but
     *            also be stored as array with an ending .array key. Those arrays will not be flattened further more.
     *            This means any nesting array will stay arrays in this array.
     *
     * @return string|array
     */
    private function process(array $array, $prefix = '')
    {
        $result = [];

        foreach ($array as $key => $value) {

            // Subarrray handling needed?
            if (is_array($value)) {

                // __preserve key set tha signals us to store the array as it is?
                if ($this->preserve_flagged_arrays && array_key_exists('__preserve', $value)) {
                    $result[$prefix . $key . $this->glue . 'array'] = $value;
                    unset($value['__preserve']);
                }

                // Flatten the array
                $result = $result + $this->process($value, $prefix . $key . $this->glue, $this->glue, $this->preserve_flagged_arrays);
            }
            else {
                $result[$prefix . $key] = $value;
            }
        }
        return $result;
    }
}

