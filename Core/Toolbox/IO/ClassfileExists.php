<?php
namespace Core\Toolbox\IO;

/**
 * ClassfileExists.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
class ClassfileExists
{
    
    use ReplaceDirectorySeperatorTrait;

    /**
     *
     * @var string;
     */
    private $classname;

    /**
     *
     * @var string
     */
    private $basedir = '';

    public function __construct(string $classname)
    {
        $this->setClassname($classname);
    }

    /**
     *
     * @param string $classname
     *            The classname as single name or with namespace
     */
    public function setClassname(string $classname)
    {
        $this->classname = $classname;
    }

    /**
     * Returns the classname
     *
     * @return string
     */
    public function getClassname(): string
    {
        return $this->classname;
    }

    /**
     * Sets the basedir to be prepended to classname.php
     *
     * @param string $basedir            
     */
    public function setBasedir(string $basedir)
    {
        $this->basedir = $basedir;
    }

    /**
     * Returns the basedir
     *
     * @return string
     */
    public function getBasedir(): string
    {
        return $this->basedir;
    }

    /**
     * Checks for existing class file of a given classname
     *
     * Takes care of namespaces.
     *
     * @return boolean
     */
    public function check(): bool
    {
        // convert namespace into path
        $class = str_replace('\\', '/', $this->class);
        
        // append .php?
        if (strpos($class, '.php') === false) {
            $class .= '.php';
        }
        
        $class = $this->replaceDirectorySeperator($class);
        
        if (!empty($this->basedir)) {
            $class = $this->basedir .= DIRECTORY_SEPARATOR;
        }
        
        return file_exists($class);
    }
}

