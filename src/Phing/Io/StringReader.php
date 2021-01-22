<?php
/**
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information please see
 * <http://phing.info>.
 */

namespace Phing\Io;

/**
 * Dummy class for reading from string of characters.
 *
 * @package phing.system.io
 */
class StringReader extends InputStreamReader
{

    /**
     * @var string
     */
    private $string;

    /**
     * @var int
     */
    private $mark = 0;

    /**
     * @var int
     */
    private $currPos = 0;

    /**
     * @param $string
     */
    public function __construct($string)
    {
        $this->string = $string;
    }

    /**
     * @param int $n
     */
    public function skip($n)
    {
    }

    /**
     * @param null $len
     * @return int|string
     */
    public function read($len = null)
    {
        if ($len === null) {
            return $this->string;
        }

        if ($this->currPos >= strlen($this->string)) {
            return -1;
        }
        $out = substr($this->string, $this->currPos, $len);
        $this->currPos += $len;

        return $out;
    }

    public function mark()
    {
        $this->mark = $this->currPos;
    }

    public function reset()
    {
        $this->currPos = $this->mark;
    }

    public function close()
    {
    }

    public function open()
    {
    }

    public function ready()
    {
    }

    /**
     * @return bool
     */
    public function markSupported()
    {
        return true;
    }

    /**
     * @return string
     */
    public function getResource()
    {
        return '(string) "' . $this->string . '"';
    }
}
