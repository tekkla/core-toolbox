<?php
namespace Core\Toolbox\IO;

use Core\Toolbox\Converter\Filesize;

/**
 * Upload.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016-2017
 * @license MIT
 */
class Upload extends AbstractFile
{

    /**
     *
     * @var string
     */
    private $destination = '';

    /**
     *
     * @var bool
     */
    private $check_exists = true;

    /**
     * Sets destination
     *
     * @param string $destination
     *            Destination of the uploaded file
     */
    public function setDestination(string $destination)
    {
        $this->destination = $destination;
    }

    /**
     * Retruns destination
     *
     * @return string
     */
    public function getDestination(): string
    {
        return $this->destination;
    }

    /**
     * Set flag to check if the destination already exists
     *
     * @param bool $check_exists
     */
    public function setCheckExists(bool $check_exists)
    {
        $this->check_exists = $check_exists;
    }

    /**
     * Returns check destination already exists flag
     *
     * @return bool
     */
    public function getCheckExists(): bool
    {
        return $this->check_exists;
    }

    /**
     * Returns the maximum size for uploads in bytes
     *
     * @return int
     */
    public function getMaximumFileUploadSize()
    {
        $converter = new Filesize(ini_get('upload_max_filesize'));

        return $converter->phpSizeToBytes();
    }

    /**
     * Same as php's core move_uploaded_file extended with optional destination file exists check.
     *
     * @throws FileException when exists check is requested and destination already exists
     *
     * @return boolean
     */
    public function moveFile(): bool
    {
        if ($this->check_exists == true && file_exists($this->destination)) {
            Throw new FileException(sprintf('Destinationfile "%s" already exits.', $this->destination));
        }

        return move_uploaded_file($this->filename, $this->destination);
    }
}
