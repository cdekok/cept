<?php
namespace Cept\Conversion\Converter;

use Cept\Conversion\Reader\ReaderInterface;
use Cept\Conversion\Writer\WriterInterface;

abstract class ConverterAbstract implements ConverterInterface
{
    use \Cept\Traits\Options;

    /**
     * Reader
     * @var ReaderInterface
     */
    protected $reader;

    /**
     * Writer
     * @var WriterInterface
     */
    protected $writer;

    /**
     * Mapping array of reader to write
     * @var array
     */
    protected $mapping;

    public function __construct(array $options = null)
    {
        if ($options) {
            $this->setOptions($options);
        }
    }

    /**
     * Set reader
     * @param ReaderInterface $reader
     */
    public function setReader(ReaderInterface $reader)
    {
        $this->reader = $reader;
    }

    /**
     * Set writer
     * @param WriterInterface $writer
     */
    public function setWriter(WriterInterface $writer)
    {
        $this->writer = $writer;
    }

    /**
     * Get mapping
     * @return array
     */
    public function getMapping()
    {
        return $this->mapping;
    }

    /**
     * Set mapping
     * @param array $mapping
     * @return \Cept\Conversion\Converter\ConverterAbstract
     */
    public function setMapping(array $mapping)
    {
        $this->mapping = $mapping;
        return $this;
    }
}
