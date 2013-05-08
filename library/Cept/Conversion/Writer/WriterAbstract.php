<?php
namespace Cept\Conversion\Writer;

use Zend\EventManager\EventManager;

abstract class WriterAbstract implements WriterInterface
{
    /**
     * Event manager
     * @var EventManager
     */
    protected $eventManager;

    /**
     * Set event manager
     * @param EventManager $eventManager
     * @return \Cept\Conversion\Writer\WriterAbstract
     */
    public function setEventManager(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
        return $this;
    }

    /**
     * Get event manager
     * @return EventManager
     */
    public function getEventManager()
    {
        return $this->eventManager;
    }
}
