<?php

namespace Cept\Db;

use Zend\Db\Adapter\Adapter;

/**
 * Db functionality, depends on Zendframework/Db
 *
 * @package Cept\Db
 */
class Db
{
    /**
     * Mysql db
     */
    const DB_MYSQL = 'Mysql';

    /**
     * Postgresql db
     */
    const DB_POSTGRESQL = 'Postgresql';

    /**
     * Sqlite db
     */
    const DB_SQLITE = 'Sqlite';

    /**
     * Oracle db
     */
    const DB_ORACLE = 'Oracle';

    /**
     * Db adapter
     * @var Adapter
     */
    protected $adapter;

    /**
     * Driver
     * @var \Cept\Db\Driver\DriverInterface
     */
    protected $driver;

    /**
     *
     * @param Adapter $adapter
     */
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     *
     * @return type
     * @throws Exception
     */
    public function getDriver()
    {
        if (!$this->driver) {
            switch ($this->getServer()) {
                case self::DB_POSTGRESQL:
                    $this->driver = new Driver\Postgresql($this->adapter);
                    break;
                case self::DB_MYSQL:
                    $this->driver = new Driver\Mysql($this->adapter);
                    break;
                default:
                    throw new \Exception('Database not supported');
                    break;
            }
        }
        return $this->driver;
    }

    /**
     * Get type of database server connected
     *
     * @return string
     */
    public function getServer()
    {
        return $this->adapter->getDriver()->getDatabasePlatformName();
    }
}
