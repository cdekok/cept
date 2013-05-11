<?php
namespace Cept\Db\Driver;

interface DriverInterface
{
    /**
     *
     * @param \Zend\Db\Adapter\Adapter $db
     */
    public function __construct(\Zend\Db\Adapter\Adapter $db);

    /**
     * Get tables in current select database
     * @param array $schema
     * @return \Zend\Db\ResultSet
     */
    public function getTables($schema = null);
}
