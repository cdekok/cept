<?php
namespace Cept\Conversion\Converter;

interface ConverterInterface
{
    /**
     * Event triggerd before write
     */
    const EVENT_PRE_WRITE = 'CEPT_CONVERSION_CONVERTER_EVENT_PRE_WRITE';

    /**
     * Event triggered after write
     */
    const EVENT_POST_WRITE = 'CEPT_CONVERSION_CONVERTER_EVENT_POST_WRITE';

    /**
     * Set writer
     * @param \Cept\Conversion\Writer\WriterInterface $writer
     */
    public function setWriter(\Cept\Conversion\Writer\WriterInterface $writer);

    /**
     * Set reader
     * @param \Cept\Conversion\Reader\ReaderInterface $reader
     */
    public function setReader(\Cept\Conversion\Reader\ReaderInterface $reader);

    /**
     * Start convert data
     */
    public function start();

    /**
     * Set options
     */
    public function setOptions(array $options);
}
