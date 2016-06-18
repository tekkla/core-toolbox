<?php
namespace Core\Toolbox\IO;

/**
 * ReplaceDirectorySeperatorTrait.php
 *
 * @author Michael "Tekkla" Zorn <tekkla@tekkla.de>
 * @copyright 2016
 * @license MIT
 */
trait ReplaceDirectorySeperatorTrait {

    private function replaceDirectorySeperator($filename)
    {
        return str_replace([
            '\\',
            '/'
        ], DIRECTORY_SEPARATOR, $filename);
    }
}

