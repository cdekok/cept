<?php
namespace Cept\Traits;

trait Options
{
    /**
     * Set all options with object setters
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        foreach ($options as $method => $option) {
            $method = 'set'.ucfirst($method);
            if (method_exists($this, $method)) {
                $this->$method($option);
            }
        }
        return $this;
    }
}
