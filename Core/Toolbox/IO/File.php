<?php
namespace Core\Toolbox\IO;

use Psr\Log\LoggerInterface;
use Core\Toolbox\Strings\Normalize;

/**
 * File.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class File extends AbstractFile
{
    use ReplaceDirectorySeperatorTrait;

    /**
     * Deletes a file or a complete directory tree
     *
     * @param boolean $clean_only
     *            Flag to delete only files while a directorystructure stays intact
     *
     * @return bool
     */
    public function delete($clean_only = false): bool
    {
        $path = $this->replaceDirectorySeperator($this->filename);

        if (!file_exists($path)) {
            return true;
        }

        if (!is_dir($path)) {
            return unlink($path);
        }

        $files = scandir($path);

        foreach ($files as $item) {

            $file = $path . DIRECTORY_SEPARATOR . $item;

            if (is_dir($file)) {
                $this->delete($file);
            }
            else {
                unlink($file);
            }
        }

        return $clean_only == false ? rmdir($path) : true;
    }

    /**
     * Moves the source to the destination.
     * Both parameter have to be a full paths.On success the return value will be the destination path.
     * Otherwise it will be boolean false.
     *
     * @param string $source
     *            Path to source file
     * @param string $destination
     *            Path to destination file
     *
     * @return string boolean
     */
    public function move($destination)
    {
        if (copy($this->filename, $destination)) {
            unlink($this->filename);

            $this->filename = $destination;

            return $destination;
        }
        else {
            return false;
        }
    }

    /**
     * Wrapper method for file_exists() plus logging feature
     *
     * @param string $filename
     *            Complete path to file
     * @param LoggerInterface $logger
     *            Optional logger component to track notices when file does not exist
     *
     * @return boolean
     */
    public function exists(LoggerInterface $logger = null): bool
    {
        $filename = $this->replaceDirectorySeperator($this->filename);
        $exists = file_exists($filename);

        if (!$exists && isset($logger)) {
            $logger->notice(sprintf('File "%s" not found.', $filename));
        }

        return $exists;
    }



    /**
     * Cleans up a filename string from all characters which can make trouble on filesystems.
     *
     * @param string $name
     *            The string to cleanup
     * @param string $delimiter
     *
     * @return string
     */
    public function clean($delimiter = '-')
    {
        // The fileextension should not be normalized.
        if (strrpos($this->filename, '.') !== false) {
            list ($name, $extension) = explode('.', $this->filename);
        }

        $normalize = new Normalize($name);

        $name = $normalize->normalize();
        $name = preg_replace('/[^[:alnum:]\-]+/', $delimiter, $name);
        $name = preg_replace('/' . $delimiter . '+/', $delimiter, $name);
        $name = rtrim($name, $delimiter);

        $cleaned = isset($extension) ? $name . '.' . $extension : $name;

        return $cleaned;
    }

    /**
     * Returns an array of files inside the given directory path.
     *
     * @param string $path
     *            Directory path to get filelist from
     *
     * @throws FileException
     *
     * @return void multitype:string
     */
    public function getFilenamesFromDir($path, $recursive = false)
    {
        // Add trailing slash if missing
        if (substr($path, -1) != '/') {
            $path .= '/';
        }

        $path = $this->replaceDirectorySeperator($path);

        $filenames = [];

        // No handle, error exception
        if (!file_exists($path)) {
            Throw new FileException(sprintf('Path "%s" not found.', $path, 2000));
        }

        $files = scandir($path);

        foreach ($files as $file) {

            // no '.' or '..'
            if ($file{0} == '.') {
                continue;
            }

            if (is_dir($path . $file) && $recursive) {
                $filenames[$file] = $this->getFilenamesFromDir($path . $file, $recursive);
            }
            else {
                continue;
            }

            // store filename
            $filenames[$file] = $file;
        }

        return $filenames;
    }
}
