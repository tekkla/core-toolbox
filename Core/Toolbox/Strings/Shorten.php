<?php
namespace Core\Toolbox\Strings;

/**
 * Shorten.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class Shorten extends AbstractStrings
{

    /**
     *
     * @var int
     */
    private $length;

    /**
     *
     * @var string
     */
    private $endstring = '. ';

    /**
     *
     * @var string
     */
    private $addition = '[...]';

    /**
     *
     * @var string
     */
    private $wrap_url;

    /**
     * Returns the lenght of string before it gets shortened
     *
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * Returns the lenght of string before it gets shortened
     *
     * @param int $length
     *            The length
     */
    public function setLength(int $length)
    {
        $this->length = $length;
    }

    /**
     * Returns the string that is used as mark after that the string gets shortened
     *
     * @return string
     */
    public function getEndstring(): string
    {
        return $this->endstring;
    }

    /**
     * Sets the string that is used as mark after that the string gets shortened
     *
     * @param string $endstring
     */
    public function setEndstring(string $endstring)
    {
        $this->endstring = $endstring;
    }

    /**
     * Returns the addition that will be prepended the shortened string
     *
     * @return string
     */
    public function getAddition(): string
    {
        return $this->addition;
    }

    /**
     * Sets the addition that will be prepended the shortened string
     *
     * @param string $addition
     */
    public function setAddition(string $addition)
    {
        $this->addition = $addition;
    }

    /**
     * Returns the url that is used to wrap the additional string
     *
     * @return string
     */
    public function getWrapUrl(): string
    {
        return $this->wrap_url;
    }

    /**
     * Sets the url that is used to wrap the additional string
     *
     * @param string $wrap_url
     */
    public function setWrapUrl(string $wrap_url)
    {
        $this->wrap_url = $wrap_url;
    }

    /**
     * Shortens a string to the given length and appends the additional string that can be wrapped by a link when a
     * wrap url is set.
     *
     * @return string
     */
    public function shorten(): string
    {
        // Shorten only what is longer than the length
        if (strlen($this->string) < $this->length) {
            return $this->string;
        }

        // Shorten string by length
        $this->result = substr($this->string, 0, $this->length);

        // Shorten further until last occurence of a ' '
        $string = substr($this->result, 0, strrpos($this->result, $this->endstring));

        if (!empty($this->wrap_url)) {
            $addition = '<a href="' . $this->wrap_url . '">' . $this->addition . '</a>';
        }

        // Add addition
        $this->result .= $addition;

        // Done.
        return $this->result;
    }
}

