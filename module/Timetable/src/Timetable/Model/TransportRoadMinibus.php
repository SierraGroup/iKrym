<?php
namespace Timetable\Model;

// Add these import statements
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

    class TransportRoadMinibus{
                    public $transport_road_minibus_id;
                    public $transport_road_id;
                    public $transport_id;
                    public $transport_road_minibus_number;
                    public $transport_road_minibus_model;
                    public $transport_road_minibus_count;
                    public $transport_road_minibus_time_work;
                    public $transport_road_minibus_price;
                    public $transport_road_minibus_stand_up;
                    public $transport_road_minibus_seating;


                    public  function exchangeArray($data){
                        $this->transport_road_minibus_id = (!empty($data['transport_road_minibus_id'])) ? $data['transport_road_minibus_id'] : null;
                        $this->transport_road_id = (!empty($data['transport_road_id'])) ? $data['transport_road_id'] : null;
                        $this->transport_id = (!empty($data['transport_id'])) ? $data['transport_id'] : null;
                        $this->transport_road_minibus_number = (!empty($data['transport_road_minibus_number'])) ? $data['transport_road_minibus_number'] : null;
                        $this->transport_road_minibus_model = (!empty($data['transport_road_minibus_model'])) ? $data['transport_road_minibus_model'] : null;
                        $this->transport_road_minibus_count = (!empty($data['transport_road_minibus_count'])) ? $data['transport_road_minibus_count'] : null;
                        $this->transport_road_minibus_time_work = (!empty($data['transport_road_minibus_time_work'])) ? $data['transport_road_minibus_time_work'] : null;
                        $this->transport_road_minibus_price= (!empty($data['transport_road_minibus_price'])) ? $data['transport_road_minibus_price'] : null;
                        $this->transport_road_minibus_stand_up= (!empty($data['transport_road_minibus_stand_up'])) ? $data['transport_road_minibus_stand_up'] : null;
                        $this->transport_road_minibus_seating = (!empty($data['transport_road_minibus_seating'])) ? $data['transport_road_minibus_seating'] : null;

                    }
                    public  function getArrayCopy(){
                        //Gets the properties of the given object
                        return get_object_vars($this);
                    }
        public function setInputFilter(InputFilterInterface $inputFilter)
        {
            throw new \Exception("Not used");
        }




}