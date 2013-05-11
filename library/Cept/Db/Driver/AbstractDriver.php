<?php
namespace Cept\Db\Driver;

use Zend\Db\Adapter\Adapter;

abstract class AbstractDriver implements DriverInterface
{
    /**
     *
     * @var Adapter
     */
    protected $adapter;

    /**
     *
     * @param Adapter $adapter
     */
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Get tables in current selected database
     * @param type $schema
     * @return \Zend\Db\ResultSet
     */
    public function getTables($schema = null)
    {
        // Postgresql
        if (!$schema) {
            $schema = $this->adapter->getCurrentSchema();
        }
        $schema = $this->adapter->getPlatform()->quoteValue($schema);
        $sql = 'SELECT table_name FROM information_schema.tables WHERE table_schema = '.$schema.'
            ORDER BY table_name ASC';
        return $this->adapter->query($sql, Adapter::QUERY_MODE_EXECUTE);
    }
}
