<?php
namespace Cept\Conversion\Converter;

class Db extends ConverterAbstract
{
    /**
     * Db writer
     * @var \Cept\Conversion\Writer\Db
     */
    protected $writer;

    /**
     * Start import
     */
    public function start()
    {
        $db = $this->writer->getDb();
        $conn = $db->getDriver()->getConnection();
        $conn->beginTransaction();
        $em = $this->writer->getEventManager();
        try {
            while ($row = $this->reader->fetch()) {
                $newRow = $this->applyMapping($row);
                $this->writer->write($newRow);
            }
            $conn->commit();
        } catch (Exception $exc) {
            $conn->rollback();
            throw $exc;
        }
    }

    /**
     * Apply mapping to get the new row
     *
     * @param array $row
     * @return array New row to save
     */
    protected function applyMapping($row)
    {
        $newRow = array();
        foreach ($this->mapping as $src => $dest) {
            $newRow[$dest] = $row[$src];
        }
        return $newRow;
    }
}
