<?php
namespace TypeRocket\Fields;

use \TypeRocket\Html\Generator as Generator;

class Select extends Field implements FieldOptions
{

    private $options = array();

    public function __construct()
    {
        $this->setType('select');
    }

    function getString()
    {
        $default = $this->getSetting('default');
        $option = $this->getValue();
        $option     = ! is_null($option) ? $this->getValue() : $default;

        $generator  = new Generator();
        $generator->newElement( 'select', $this->getAttributes() );

        foreach ($this->options as $key => $value) {

            $attr['value'] = $value;
            if ($option == $value) {
                $attr['selected'] = 'selected';
            } else {
                unset( $attr['selected'] );
            }

            $generator->appendInside( 'option', $attr, (string) $key );

        }

        return $generator->getString();
    }

    public function setOption( $key, $value )
    {
        $this->options[ $key ] = $value;

        return $this;
    }

    public function setOptions( $options )
    {
        $this->options = $options;

        return $this;
    }

    public function getOption( $key, $default = null )
    {
        if ( ! array_key_exists( $key, $this->options ) ) {
            return $default;
        }

        return $this->options[ $key ];
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function removeOption( $key )
    {
        if ( array_key_exists( $key, $this->options ) ) {
            unset( $this->options[ $key ] );
        }

        return $this;
    }

}