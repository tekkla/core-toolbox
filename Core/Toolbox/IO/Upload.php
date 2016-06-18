<?php
namespace Core\Toolbox\IO;

/**
 * Upload.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class Upload
{

    /**
     *
     * @var Files
     */
    private $files;

    public function __construct(Files $files)
    {
        $this->files = $files;
    }

    /**
     * Returns the maximum size for uploads in bytes.
     *
     * @return int
     */
    public function getMaximumFileUploadSize()
    {
        return $this->files->convertPHPSizeToBytes(ini_get('upload_max_filesize'));
    }

    /**
     * Same as php's core move_uploaded_file extended with destination file exists
     * check.
     * Fails this check an exception is throwm.
     *
     * @param string $source            
     * @param string $destination            
     * @param bool $check_exists            
     *
     * @throws FileException
     *
     * @return boolean
     */
    public function moveFile(string $source, string $destination, bool $check_exists = true): bool
    {
        if ($check_exists == true && $this->files->exists($destination)) {
            Throw new FileException('File already exits');
        }
        
        return move_uploaded_file($source, $destination);
    }
}

