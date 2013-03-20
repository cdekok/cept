<?php
namespace Cept\Conversion\Reader;

use Zend\EventManager\EventManager;

/**
 *
 * @author cdekok
 */
interface ReaderInterface
{
    /**
     * Return an array of data
     *
     * @return array
     */
    public function fetch();

    /**
     * Set event manager
     * @param EventManager $eventManager
     */
    public function setEventManager(EventManager $eventManager);
}
