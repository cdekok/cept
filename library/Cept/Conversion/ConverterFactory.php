<?php
namespace Cept\Conversion;

class ConverterFactory
{
    /**
     * Get converter
     *
     * @param type $reader
     * @param \Cept\Conversion\Db $writer
     * @return \Cept\Conversion\Converter\ConverterInterface
     * @throws \InvalidArgumentException
     */
    public static function factory(array $options)
    {
        //
        if ($options['writer'] instanceof \Cept\Conversion\Writer\Db) {
            $converter = new \Cept\Conversion\Converter\Db($options);
            return $converter;
        }
        throw new \InvalidArgumentException('No converter available');
    }
}
