<?php
namespace Restaurant\Model;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\FileInput;
class RestaurantMenu{

    public  $restaurant_menu_id;
    public $restaurant_id_name;
    public $restaurant_menu_type_image;
    public $restaurant_menu_type;


    protected $inputFilter;

    public  function exchangeArray($data){
        $this->restaurant_menu_id = (!empty($data['restaurant_menu_id'])) ? $data['restaurant_menu_id'] : null;
        $this->restaurant_id_name  = (!empty($data['restaurant_id_name'])) ? $data['restaurant_id_name'] : null;
        $this->restaurant_menu_type_image  = (!empty($data['restaurant_menu_type_image'])) ? $data['restaurant_menu_type_image'] : null;
        $this->restaurant_menu_type  = (!empty($data['restaurant_menu_type'])) ? $data['restaurant_menu_type'] : null;
    }
    public function getArrayCopy(){
        return get_object_vars($this);
    }
    public  function getInputFilter(){
        if(!$this->inputFilter){
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
            $file = new FileInput('restaurant_menu_type_image');

            $file->setRequired(true);
            $file->getFilterChain()->attachByName(
                'filerenameupload',
                array(
                    'target'          => './yalta/img/restaurants/menu/type/*',
                    'overwrite'       => true,
                    'use_upload_name' => true,
                )
            );
            $inputFilter->add($file);

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
                            'max' => '1000',
                        ),
                    ),
                ),
            )));
        $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
}