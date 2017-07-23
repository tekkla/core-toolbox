<?php
namespace Core\Toolbox\IO;

/**
 * Download.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class Download
{

    /**
     * Source (url) to load date from
     *
     * @var string
     */
    private $source = '';

    /**
     * Target where to save download result
     *
     * @var string
     */
    private $target = '';

    /**
     *
     * @param string $source            
     * @param string $target            
     */
    public function __construct(string $source = null, string $target = null)
    {
        if (!empty($source)) {
            $this->source = $source;
        }
        
        if (!empty($target)) {
            $this->target = $target;
        }
    }

    /**
     * Fetches an url and writes the returned content to a file
     *
     * @param string $url
     *            URL to request
     * @param string $target
     *            Filepath to store the result
     *            
     * @throws DownloadException
     *
     * @return bool
     */
    public function download(): bool
    {
        if (empty($this->source)) {
            Throw new DownloadException('No source for download set.');
        }
        
        if (empty($this->target)) {
            Throw new DownloadException('No target for download set.');
        }
        
        try {
            $data = $this->fetch($this->source);
            
            if (preg_match('/Found/', $data)) {
                return false;
            }
            
            file_put_contents($this->target, $data);
            
            return true;
        }
        catch (\Throwable $t) {
            Throw new DownloadException(sprintf('Download of source "%s" failed with error: $s', $this->source, $t->getMessage()));
            return false;
        }
    }

    /**
     * Fetches an url and returns the returned data
     *
     * @param string $url
     *            Url to load
     * @param number $return
     *            Flag to expect return value
     * @param number $timeout
     *            Max timeout
     * @param string $lang
     *            Language of useragent to send
     *            
     * @return mixed
     */
    private function getCurl(string $url, int $return = 1, int $timeout = 10, string $lang = 'de-DE')
    {
        // Define useragent
        $agent = 'Mozilla/5.0 (Windows; U; Windows NT 6.1; ' . $lang . '; rv:1.9.2.12) Gecko/20101026 Firefox/3.6.12';
        
        // Url encode
        $url = urlencode($url);
        
        // Language of request
        $lang = array(
            'Accept-Language: ' . $lang
        );
        
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $lang);
        curl_setopt($curl, CURLOPT_USERAGENT, $agent);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, $return);
        curl_setopt($curl, CURLOPT_URL, $url);
        
        $result = curl_exec($curl);
        
        curl_close($curl);
        
        return $result;
    }
}

