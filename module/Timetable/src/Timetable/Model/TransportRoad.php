<?php
        namespace Timetable\Model;
        use Zend\InputFilter\Factory as InputFactory;
        use Zend\InputFilter\InputFilter;
        class transport_road {

            public $transport_road_id;
            public $transport_id;
            public $transport_road_id_name;
            public $transport_road_name;
            protected $input_filter;

            public  function exchangeArray($data){
                $this->transport_road_id = (!empty($data['transport_road_id'])) ? $data['transport_road_id'] : null;
                $this->transport_id = (!empty($data['transport_id'])) ? $data['transport_id'] : null;
                $this->transport_road_id_name = (!empty($data['transport_road_id_name'])) ? $data['transport_road_id_name'] : null;
                $this->transport_road_name = (!empty($data['transport_road_name'])) ? $data['transport_road_name'] : null;

            }
            public  function getArrayCopy(){
                //Gets the properties of the given object
                return get_object_vars($this);
            }
            public  function getInputFilter(){
                if($this->input_filter){
                    $inputFilter = new InputFilter();
                    $factory     = new InputFactory();
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'transport_road_id',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'Int'),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'transport_id',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'Int'),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'transport_road_id_name',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name'    => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min'      => 1,
                                    'max'      => 100,
                                ),
                            ),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'transport_road_name',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name'    => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min'      => 1,
                                    'max'      => 100,
                                ),
                            ),
                        ),
                    )));
                }
            }
        }
