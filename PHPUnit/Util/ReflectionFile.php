<?php
/**
 * PHPUnit
 *
 * Copyright (c) 2002-2010, Sebastian Bergmann <sb@sebastian-bergmann.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category   Testing
 * @package    PHPUnit
 * @author     David Harkness <dharkness@gmail.com>
 * @copyright  2002-2010 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link       http://www.phpunit.de/
 * @since      File available since Release 3.4.16
 */

require_once 'PHPUnit/Util/Filter.php';

PHPUnit_Util_Filter::addFileToFilter(__FILE__, 'PHPUNIT');

/**
 * Represents a file that contains PHP code.
 *
 * @category   Testing
 * @package    PHPUnit
 * @author     David Harkness <dharkness@gmail.com>
 * @copyright  2002-2010 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://www.phpunit.de/
 * @since      Class available since Release 3.4.16
 */
class PHPUnit_Util_ReflectionFile implements Reflector
{
    /**
     * Path to file.
     *
     * @var string
     */
    private $_file;

    /**
     * Number of lines in the file or null if not yet counted.
     *
     * @var int|null
     */
    private $_numLines = null;

    /**
     * Stores the path to the file to be reflected.
     *
     * @param  string $file
     * @throws PHPUnit_Framework_Exception if the path isn't a valid file
     */
    public function __construct($file) {
        if (!is_file($file)) {
            throw new PHPUnit_Framework_Exception($file . ' does not exist');
        }

        $this->_file = $file;
    }

    /**
     * Returns the path to the file.
     *
     * @return string
     */
    public function getName() {
        return $this->_file;
    }

    /**
     * Returns the base name of the file.
     *
     * @return string
     */
    public function getShortName() {
        return basename($this->_file);
    }


    /**
     * Returns the path to the file.
     *
     * @return string
     */
    public function getFileName() {
        return $this->_file;
    }

    /**
     * Returns the first line of the file which is always 1.
     *
     * @return int
     */
    public function getStartLine() {
        return 1;
    }

    /**
     * Returns the last line of the file.
     *
     * If the number of lines hasn't been counted yet, it is counted
     * and stored for future calls.
     *
     * @return int
     */
    public function getEndLine() {
        if (is_null($this->_numLines)) {
            $this->_numLines = count(file($this->_file));
        }
        return $this->_numLines;
    }

    /**
     * Returns a simple string representation of this reflector.
     *
     * @return string contains the path to the file
     */
    public function __toString() {
        return 'File [ ' . $this->_file . ' ]';
    }


    /**
     * Exports the given reflector.
     *
     * As this is invalid for files, this method does nothing.
     *
     * @param PHPUnit_Util_ReflectionFile $reflector
     */
    public static function export($reflector) {
        /* cannot export files */
    }
}
?>