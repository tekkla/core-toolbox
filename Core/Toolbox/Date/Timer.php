<?php
namespace Core\DateTime;

/**
 * Timer.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class Timer
{

    /**
     *
     * @var int
     */
    private $start;

    /**
     *
     * @var int
     */
    private $end;

    /**
     *
     * @var bool
     */
    private $running = false;

    /**
     *
     * @var array
     */
    private $checkpoints = [];

    /**
     * Starts timer and creates first checkpoint
     *
     * @throws \RuntimeException
     *
     * @return Timer
     */
    public function start()
    {
        if ($this->running) {
            Throw new \RuntimeException('Timer is already running.');
        }

        $this->start = microtime(true);
        $this->checkpoints['start'] = $this->start;
        $this->running = true;

        return $this;
    }

    /**
     * Stopps timer and returns difference from start
     *
     * @throws \Exception
     */
    public function stop()
    {
        if (! $this->running) {
            Throw new \Exception('Timer is not running.');
        }

        $this->end = microtime(true);
        $this->checkpoints['end'] = $this->end;
        $this->running = false;

        return $this->getDiff();
    }

    /**
     * Adds a new named checkpoint which measures the time between now and the last checkpooint.
     *
     * @param string $name
     */
    public function checkpoint(string $name)
    {
        $this->checkpoints[$name] = microtime(true) - end($this->checkpoints);
    }

    /**
     * Returns the start time.
     *
     * @return integer
     */
    private function getStart(): int
    {
        return $this->start;
    }

    /**
     * Stopps timer and returns it's ending time.
     * Sets also endcheckpoint
     *
     * @return mixed
     */
    private function getEnd()
    {
        if ($this->running) {
            $this->stop();
        }

        return $this->end;
    }

    /**
     * Calculates and returns the time between start and end.
     *
     * @return number
     */
    public function getDiff()
    {
        return $this->getEnd() - $this->getStart();
    }

    /**
     * Resets timer to current time.
     */
    public function reset()
    {
        $this->start = 0;
    }
}
