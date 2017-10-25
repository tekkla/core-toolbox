<?php
namespace Core\Toolbox\Converter;

/**
 * Filesize.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016-2017
 * @license MIT
 */
class Filesize extends AbstractConverter
{

    /**
     * Transforms the php.ini notation for numbers (like '2M') to an integer (2*1024*1024 in case of 2M)
     *     
     * @return int Size in bytes
     */
    public function sizeToBytes(): int
    {
        if (! is_string($this->value)) {
            return $this->value;
        }
        
        $suffix = substr($this->value, - 1);
        $value = substr($this->value, 0, - 1);
        
        switch (strtoupper($suffix)) {
            case 'P':
                $value *= 1024;
            case 'T':
                $value *= 1024;
            case 'G':
                $value *= 1024;
            case 'M':
                $value *= 1024;
            case 'K':
                $value *= 1024;
                break;
        }
        
        return $this->result = $value;
    }

    /**
     * Converts a filesize (bytes as integer) into a human readable string format.
     * For example: 1024 => 1K
     *
     * @param array $units
     *            Optional unit strings
     * @param string $format
     *            The outputformat
     *            
     * @throws ConverterException
     *
     * @return string unknown
     */
    public function byteToSize(array $units = null, string $format = '%d%s')
    {
        if (! $this->value == '0' . $this->value) {
            Throw new ConverterException(sprintf('Wrong parameter type'));
        }
        
        if ($this->value > 0) {
            $unit = intval(log($this->value, 1024));
            
            if (! isset($units)) {
                $units = [
                    'K',
                    'M',
                    'G',
                    'T',
                    'P'
                ];
            }
            
            if (array_key_exists($unit, $units) === true) {
                return $this->result = sprintf($format, $this->value / pow(1024, $unit), $units[$unit]);
            }
        }
        
        return $this->result = $this->value;
    }
}
