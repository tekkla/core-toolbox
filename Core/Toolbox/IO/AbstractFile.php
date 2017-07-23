<?php
namespace Core\Toolbox\IO;

use Psr\Log\LoggerInterface;

/**
 * AbstractFile.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
abstract class AbstractFile
{

    /**
     *
     * @var string
     */
    protected $filename = '';

    /**
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Constructor
     *
     * @param string $filename
     *            Single filename or complete path of a file
     */
    public function __construct(string $filename)
    {
        $this->setFilename($filename);
    }

    /**
     * Sets filename
     *
     * @param string $filename
     *            Single filename or complete path of a file
     */
    public function setFilename(string $filename)
    {
        $this->filename = $filename;
    }

    /**
     * Returns filenam
     *
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * Sets logger service
     *
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}

