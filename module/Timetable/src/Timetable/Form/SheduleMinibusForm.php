<?php

namespace Timetable\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\I18n\Validator\Float;

class SheduleMinibusForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('shedule_minibus');
        $this->setAttribute('method', 'post');

        //id hidden
//        $this->add(array(
//            'name' => 'shedule_road_minibus_id',
//            'type' => 'Hidden',
//        ));
//        $this->add(array(
//            'name' => 'shedule_road_id',
//            'type' => 'Hidden',
//            'value' => 4
//        ));
        $this->add(array(
            'name' => 'shedule_road_minibus_id',
            'type' => 'Hidden',
        ));

        $shedule_road_id = new Element\Hidden('shedule_road_id');
        $shedule_road_id->setValue(4);
        $this->add($shedule_road_id);


        $transport_road_minibus_model = new Element\Text('transport_road_minibus_model');
        $transport_road_minibus_model->setLabel('Укажите модель маршрутки: ');
        $this->add($transport_road_minibus_model);

        $transport_road_minibus_price = new Element\Text('transport_road_minibus_price');
        $transport_road_minibus_price->setLabel('Укажите какая цена проезда в маршрутке:');
        $this->add($transport_road_minibus_price);

        $transport_road_minibus_time_work =  new Element\Text('transport_road_minibus_time_work');
        $transport_road_minibus_time_work->setLabel('Укажите режим работы маршрутки:');
        $this->add($transport_road_minibus_time_work);

        $shedule_road_minibus_duration = new Element\Text('shedule_road_minibus_duration');
        $shedule_road_minibus_duration->setLabel('Укажите сколько минут нужно ехать по маршруту:');
        $this->add($shedule_road_minibus_duration);

        $shedule_road_minibus_start_point = new Element\Text('shedule_road_minibus_start_point');
        $shedule_road_minibus_start_point->setLabel('Укажите начальную точку куда нужно ехать по маршруту:');
        $this->add($shedule_road_minibus_start_point);

        $shedule_road_minibus_end_point = new Element\Text('shedule_road_minibus_end_point');
        $shedule_road_minibus_end_point->setLabel('Укажите конечную точку куда нужно ехать по маршруту:');
        $this->add($shedule_road_minibus_end_point);

        $shedule_road_minibus_alternative_shedule = new Element\Text('shedule_road_minibus_alternative_shedule');
        $shedule_road_minibus_alternative_shedule ->setLabel('Укажите алтернативный маршрут:');
        $this->add($shedule_road_minibus_alternative_shedule);

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',

            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}