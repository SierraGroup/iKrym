<?php

namespace Restaurant\Model;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

class RestaurantMenuTypeDescription{

    public  $restaurant_menu_type_description_id;
    public  $restaurant_id_name;
    public  $restaurant_menu_type;
    public  $restaurant_menu_type_name;
    public  $restaurant_menu_type_name_description;
    public  $restaurant_menu_type_name_price;


    protected $inputFilter;

    public  function exchangeArray($data){
        $this->restaurant__menu_type_description_id = (!empty($data['restaurant_menu_type_description_id]'])) ? $data['restaurant_menu_type_description_id'] : null;
        $this->restaurant_id_name  = (!empty($data['restaurant_id_name'])) ? $data['restaurant_id_name'] : null;
        $this->restaurant_menu_type  = (!empty($data['restaurant_menu_type'])) ? $data['restaurant_menu_type'] : null;
        $this->restaurant_menu_type_name = (!empty($data['restaurant_menu_type_name'])) ? $data['restaurant_menu_type_name'] : null;
        $this->restaurant_menu_type_name_description = (!empty($data['restaurant_menu_type_name_description'])) ? $data['restaurant_menu_type_name_description'] : null;
        $this->restaurant_menu_type_name_price = (!empty($data['restaurant_menu_type_name_price'])) ? $data['restaurant_menu_type_name_price'] : null;
    }
    public function getArrayCopy(){
        return get_object_vars($this);
    }
    public  function getInputFilter(){
        if($this->inputFilter){
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();
            $inputFilter->add($factory->createInput(array(
                'name'     => 'restaurant_menu_id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name' => 'restaurant_id_name ',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '1',
                            'max' => '100',
                        ),
                    ),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name' => 'restaurant_menu_type',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '1',
                            'max' => '100',
                        ),
                    ),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name' => 'restaurant_menu_type_name',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '1',
                            'max' => '100',
                        ),
                    ),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name' => 'restaurant_menu_type_name_description',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '1',
                            'max' => '100',
                        ),
                    ),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name' => 'restaurant_menu_type_name_price',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '1',
                            'max' => '100',
                        ),
                    ),
                ),
            )));


        }
        return $this->inputFilter;
    }
}