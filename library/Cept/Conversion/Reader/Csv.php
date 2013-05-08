<?php
namespace Cept\Conversion\Reader;

use Cept\Csv\Reader;
use InvalidArgumentException;

class Csv extends ReaderAbstract
{
    use \Cept\Traits\Options;

    /**
     * CSV file
     * @var string
     */
    protected $file;

    /**
     * Filehandle
     * @var resource
     */
    protected $fileHandle;

    /**
     * CSV Delimiter
     * @var string
     */
    protected $delimiter;

    /**
     * CSV Enclosure
     * @var string
     */
    protected $enclosure;

    /**
     * Current row
     * @var integer
     */
    protected $currentRow = 0;

    /**
     * First row count when validate is on
     * @var integer
     */
    protected $firstRowCount;

    /**
     * Validate if no escaping issues can be found
     * @var boolean
     */
    protected $validate = true;

    /**
     * Skip first row (usefull for if it's a header)
     * @var boolean
     */
    protected $skipFirst = false;

    /**
     *
     * @todo move some param to setters / getters
     * @param string $file
     * @param string $delimter
     * @param string $enclosure
     * @throws InvalidArgumentException
     */
    public function __construct(array $options)
    {
        $file = null;
        $delimiter = ',';
        $enclosure = '"';
        extract($options);
        if (!file_exists($file) || !is_readable($file)) {
            throw new InvalidArgumentException('File is not readable: '.$file);
        }
        $this->fileHandle = fopen($file, 'r');
        $this->delimiter = $delimiter;
        $this->enclosure = $enclosure;
    }

    /**
     * Can be used to iterate over a csv
     *
     * @return array
     */
    public function fetch()
    {
        $this->currentRow++;
        $row = fgetcsv($this->fileHandle, 0, $this->delimiter, $this->enclosure);

        if($row && $this->validate) {
            if($this->currentRow === 1) {
                $this->firstRowCount = count($row);
            }
            if(count($row) !== $this->firstRowCount) {
                throw new Csv\EscapeException('Current row ('.$this->currentRow.') does not match first row count');
            }
        }

        // Skip first row if it's a header
        if($this->skipFirst === true && $this->currentRow === 1) {
            return $this->fetch();
        }

        return $row;
    }

    /**
     * Get current row in csv
     * @return integer
     */
    public function getCurrentRow()
    {
        return $this->currentRow;
    }

    /**
     * SKip first row. (Usefull if it's a header)
     * @param boolean $val
     * @return Reader
     */
    public function skipFirst($val = true)
    {
        $this->skipFirst = $val;
        return $this;
    }

    /**
     * Close file
     */
    public function __destruct()
    {
        fclose($this->fileHandle);
    }
}
