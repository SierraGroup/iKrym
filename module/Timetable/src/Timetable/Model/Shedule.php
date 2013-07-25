<?php
    namespace Timetable\Model;

    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;

    class Shedule{

        public $shedule_id;
        public $transport_id;
        public $shedule_mode;

        protected $input_filter;

        public  function exchangeArray($data){
            $this->shedule_id  = (!empty($data['shedule_id '])) ? $data['shedule_id '] : null;
            $this->transport_id  = (!empty($data['transport_id'])) ? $data['transport_id'] : null;
            $this->shedule_mode = (!empty($data['shedule_mode'])) ? $data['shedule_mode'] : null;

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
                    'name'     => 'shedule_id',
                    'required' => true,
                    'filters'  => array(
                        array('name' => 'Int'),
                    ),
                )));
                $inputFilter->add($factory->createInput(array(
                    'name'     => 'shedule_mode',
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