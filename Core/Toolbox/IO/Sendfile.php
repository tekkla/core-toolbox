<?php
namespace Core\Toolbox\IO;

/**
 * Sendfile.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class Sendfile extends AbstractFile
{
    use GetMimeTypeTrait;

    /**
     * Files content type
     *
     * @var string
     */
    private $content_type = '';

    /**
     * Send inline flag
     *
     * @var bool
     */
    private $inline = false;

    /**
     * Optional name of file to send
     *
     * @var string
     */
    private $name = '';

    /**
     * Download rate limiter
     *
     * @var int
     */
    private $download_rate = 0;

    /**
     * Header stack
     *
     * @var array
     */
    private $headers = [];

    /**
     * Returns content type of file
     *
     * Tries to autodetect content type when no type is set.
     *
     * @return the $content_type
     */
    public function getContentType(): string
    {
        if (empty($this->content_type) && !empty($this->file)) {
            $this->content_type = $this->getMimeType($this->file);
        }

        return $this->content_type;
    }

    /**
     * Sets content type of file
     *
     * @param string $content_type
     *            The content type of file
     */
    public function setContentType(string $content_type)
    {
        $this->content_type = $content_type;
    }

    /**
     * Returns files content disposition flag
     *
     * @return bool
     */
    public function getInline(): bool
    {
        return $this->inline;
    }

    /**
     * Set files content disposition flag
     *
     * @param bool $inline
     *            Flags file disposal type
     */
    public function setInline(bool $inline)
    {
        $this->inline = $inline;
    }

    /**
     * Returns set invidual filename
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name of download
     *
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Returns donwload rate of the file
     *
     * @return int
     */
    public function getDownloadRate(): int
    {
        return $this->download_rate;
    }

    /**
     * Sets the download rate for this file
     *
     * @param int $download_rate
     *            Positive int as download rate for this file
     */
    public function setDownloadRate(int $download_rate)
    {
        if ($download_rate > 0) {
            $this->download_rate = $download_rate;
        }
    }

    /**
     * Adds a header
     *
     * @param string $header
     */
    public function addHeader(string $header)
    {
        $this->headers[] = $header;
    }

    /**
     * Adds a stack of headers
     *
     * @param array $headers
     */
    public function addHeaders(array $headers)
    {
        foreach ($headers as $header) {
            $this->addHeader($header);
        }
    }

    /**
     * Sends file to browser
     */
    public function send()
    {
        if (!file_exists($this->filename)) {

            $error = sprintf('File "%s" not found.');

            if (isset($this->logger)) {
                $this->logger->critical($error);
            }

            Throw new FileException($error);
        }

        // No content type provided?
        if (empty($this->content_type)) {
            $this->content_type = $this->getMimeType($this->filename);
        }

        // Do we have to find out the filename by our own?
        if (empty($this->name)) {
            $this->name = basename($this->filename);
        }

        // Send headers
        $this->addHeaders([
            'Content-type: ' . $this->content_type,
            'Content-Disposition: ' . $this->inline ? 'inline' : 'attachement' . '; filename="' . $this->name . '"',
            'Content-Transfer-Encoding: binary',
            'Content-Length: ' . filesize($this->filename),
            'Accept-Ranges: bytes'
        ]);

        foreach ($this->headers as $header) {
            header($header);
        }

        // Clean buffer!
        ob_clean();
        flush();

        if ($this->download_rate > 0) {

            // Open file
            $stream = fopen($this->filename, "r");

            while (!feof($stream)) {

                // Send current file part to the browser
                print fread($stream, round($this->download_rate * 1024));

                // Flush content to the browser
                flush();

                // Sleep one second
                sleep(1);
            }
            fclose($this->filename);
        }
        else {
            readfile($this->filename);
        }

        exit();
    }
}

