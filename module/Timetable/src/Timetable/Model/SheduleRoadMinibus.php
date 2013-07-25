<?php
        namespace Timetable\Model;
        use Zend\InputFilter\Factory as InputFactory;
        use Zend\InputFilter\InputFilter;

class SheduleRoadMinibus{


    public $shedule_road_minibus_id;
    public $shedule_road_id;



    public $transport_road_minibus_model;
    public $transport_road_minibus_price;
    public $transport_road_minibus_time_work;
//    public $transport_road_minibus_count;

    public $shedule_road_minibus_duration;
    public $shedule_road_minibus_start_point;
    public $shedule_road_minibus_end_point;
    public $shedule_road_minibus_alternative_shedule;


            public  function exchangeArray($data){


                $this->shedule_road_minibus_id = (!empty($data['shedule_road_minibus_id'])) ? $data['shedule_road_minibus_id'] : null;
                $this->shedule_road_id = (!empty($data['shedule_road_id'])) ? $data['shedule_road_id'] : null;

              //  $this->transport_road_minibus_id = (!empty($data['transport_road_minibus_id'])) ? $data['transport_road_minibus_id'] : null;
                $this->transport_road_minibus_model = (!empty($data['transport_road_minibus_model'])) ? $data['transport_road_minibus_model'] : null;
                $this->transport_road_minibus_price = (!empty($data['transport_road_minibus_price'])) ? $data['transport_road_minibus_price'] : null;
                $this->transport_road_minibus_time_work = (!empty($data['transport_road_minibus_time_work'])) ? $data['transport_road_minibus_time_work'] : null;


                $this->shedule_road_minibus_duration   = (!empty($data['shedule_road_minibus_duration'])) ? $data['shedule_road_minibus_duration'] : null;
                $this->shedule_road_minibus_start_point = (!empty($data['shedule_road_minibus_start_point'])) ? $data['shedule_road_minibus_start_point'] : null;
                $this->shedule_road_minibus_end_point = (!empty($data['shedule_road_minibus_end_point'])) ? $data['shedule_road_minibus_end_point'] : null;
                $this->shedule_road_minibus_alternative_shedule = (!empty($data['shedule_road_minibus_alternative_shedule'])) ? $data['shedule_road_minibus_alternative_shedule'] : null;

            }
            public  function getArrayCopy(){
                //Gets the properties of the given object
                return get_object_vars($this);
            }



}