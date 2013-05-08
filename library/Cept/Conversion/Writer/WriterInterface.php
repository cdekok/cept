<?php
namespace Cept\Conversion\Writer;

use Zend\EventManager\EventManager;

interface WriterInterface
{
    /**
     * Pre write
     */
    const EVENT_PRE_WRITE = 'CEPT_CONVERSION_WRITER_EVENT_PRE_WRITE';

    /**
     * Post write event
     */
    const EVENT_POST_WRITE = 'CEPT_CONVERSION_WRITER_EVENT_POST_WRITE';

    /**
     * Write a row
     * @param array $row
     */
    public function write(array $row);

    /**
     * Set event manager
     * @param EventManager $eventManager
     */
    public function setEventManager(EventManager $eventManager);
}
