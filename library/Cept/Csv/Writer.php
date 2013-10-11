<?php
namespace Cept\Csv;

class Writer
{
    /**
     * File pointer to the csv file
     * @var pointer
     */
    protected $filepointer;

    /**
     * Delimiter to use in csv file
     * @var string
     */
    protected $delimiter;

    /**
     * Enclosure to use in csv file
     * @var string
     */
    protected $enclosure;

    /**
     * Count of first column in the csv that is written
     * @var integer
     */
    protected $firstColumnCount;

    /**
     *
     * @param string $file Path to file on disk (if it does not exists it will try to create it)
     * @param string $delimiter
     * @param string $enclosure
     * @throws \InvalidArgumentException
     */
    public function __construct($file, $delimiter = ',', $enclosure = '"')
    {
        $this->filepointer = fopen($file, 'w');
        if ($this->filepointer === false) {
            throw new Exception\FileWriteException('Could not open (create) file to write:'.$file);
        }
        $this->delimiter = $delimiter;
        $this->enclosure = $enclosure;
    }

    /**
     * Write row to csv
     *
     * @param array $row
     * @throws \WriteException
     */
    public function write(array $row)
    {
        if ($this->firstColumnCount === null) {
            $this->firstColumnCount = count($row);
        }
        // Check if the column count is correct on every row
        if ($this->firstColumnCount !== count($row)) {
            throw new \Cept\Csv\Exception\InvalidColumnCountException(sprintf('Invalid column count the first row was %s, row given %s', $this->firstColumnCount, count($row)));
        }
        if (fputcsv($this->filepointer, $row, $this->delimiter, $this->enclosure) === false) {
            throw new \Cept\Csv\Exception\WriteException('Failed to write row to csv: '.  var_export($row, true));
        }
    }

    /**
     * Close file pointer on destruct
     */
    public function __destruct()
    {
        fclose($this->filepointer);
    }
}
