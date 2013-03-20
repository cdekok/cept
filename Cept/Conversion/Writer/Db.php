<?php
namespace Cept\Conversion\Writer;

use Cept\Conversion\Converter\Db;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\TableIdentifier;
use Zend\Db\TableGateway\TableGateway;

class Db extends WriterAbstract
{
    use \Cept\Traits\Options;

    /**
     * Table name
     * @var string
     */
    protected $table;

    /**
     * Table name
     * @var TableGateway
     */
    protected $dbTable;

    /**
     * Schema
     * @var string
     */
    protected $schema = null;

    /**
     * Database adapter
     * @var Adapter
     */
    protected $db;

    /**
     * String in row from reader with primary key, like id
     * @var string
     */
    protected $update = null;

    /**
     * Construct
     * @param array $options
     */
    public function __construct(array $options)
    {
        if($options) {
            $this->setOptions($options);
        }
    }

    /**
     * Save row to database, if id has been given row will be updated
     *
     * @param array $row
     */
    public function write(array $row)
    {
        $this->eventManager->trigger(self::EVENT_PRE_WRITE, $this, array('row' => &$row));
        $table = $this->getDbTable($this->db, $this->table, $this->schema);
        if($this->update) {
            $table->update($row, array(
                $this->update => $row[$this->update]
            ));
        } else {
            $table->insert($row);
        }
        $this->eventManager->trigger(self::EVENT_POST_WRITE, $this, array('row' => &$row));
    }

    /**
     * Get tablename
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Set table name
     * @param string $table
     * @return \Cept\Conversion\Writer\Db
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * Get schema
     * @return mixed string|null
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Set schema
     * @param string $schema
     * @return \Cept\Conversion\Writer\Db
     */
    public function setSchema($schema)
    {
        $this->schema = $schema;
        return $this;
    }

    /**
     * Get database
     * @return Adapter
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Set database
     * @param Adapter $db
     * @return \Cept\Conversion\Writer\Db
     */
    public function setDb(Adapter $db)
    {
        $this->db = $db;
        return $this;
    }

    /**
     * Get db table
     * @param Adapter $adapter
     * @param string $table
     * @param string $schema
     * @return TableGateway
     */
    protected function getDbTable(Adapter $adapter, $table, $schema = null)
    {
        if (!$this->dbTable) {
            $ti = new TableIdentifier($table, $schema);
            $table = new TableGateway($ti, $adapter);
            $this->dbTable = $table;
        }
        return $this->dbTable;
    }

    /**
     * Get update
     * @return mixed string|null
     */
    public function getUpdate()
    {
        return $this->update;
    }

    /**
     * Set update column from writer row
     * @param string $update
     * @return Db
     */
    public function setUpdate($update)
    {
        $this->update = $update;
        return $this;
    }
}
