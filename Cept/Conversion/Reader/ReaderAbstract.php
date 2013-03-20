<?php
namespace Cept\Conversion\Reader;

use Zend\EventManager\EventManager;

abstract class ReaderAbstract implements ReaderInterface
{
    /**
     * Event manager
     * @var EventManager
     */
    protected $eventManager;

    /**
     * Set event manager
     * @param EventManager $eventManager
     * @return \Cept\Conversion\Reader\ReaderAbstract
     */
    public function setEventManager(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
        return $this;
    }
}
