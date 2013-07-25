<?php

namespace Timetable\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\I18n\Validator\Float;

class MinibusForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('minibus');
        $this->setAttribute('method', 'post');

        //id hidden
        $this->add(array(
            'name' => 'transport_road_minibus_id',
            'type' => 'Hidden',
        ));

        $transport_road_id = new Element\Hidden('transport_road_id');
        $transport_road_id->setValue(4);
        $this->add($transport_road_id);


        $transport_id = new Element\Hidden('transport_id');
        $transport_id->setValue(1);
        $this->add($transport_id);


        $transport_road_minibus_number = new Element\Text('transport_road_minibus_number');
        $transport_road_minibus_number->setLabel('Укажите номер маршрутки: ');

        $this->add($transport_road_minibus_number);


        $transport_road_minibus_model = new Element\Text('transport_road_minibus_model');
        $transport_road_minibus_model->setLabel('Укажите модель маршрутки: ');
        $transport_road_minibus_model->setValue('МТ2');
        $this->add($transport_road_minibus_model);

        $transport_road_minibus_count = new Element\Text('transport_road_minibus_count');
        $transport_road_minibus_count->setLabel('Укажите количевство  маршруток даной модели: ');

        $transport_road_minibus_time_work =  new Element\Text('transport_road_minibus_time_work');
        $transport_road_minibus_time_work->setLabel('Укажите режим работы маршрутки:');

        $transport_road_minibus_price = new Element\Text('transport_road_minibus_price');
        $transport_road_minibus_price->setLabel('Укажите какая цена проезда в маршрутке:');

        $transport_road_minibus_stand_up = new Element\Text('transport_road_minibus_stand_up');
        $transport_road_minibus_stand_up->setLabel('Укажите сколько стоячих мест в маршрутке: ');


        $transport_road_minibus_seating = new Element\Text('transport_road_minibus_seating');
        $transport_road_minibus_seating->setLabel('Укажите сколько сидячих мест в маршрутке: ');

        $this->add($transport_road_minibus_count );
        $this->add($transport_road_minibus_time_work);
        $this->add($transport_road_minibus_price);
        $this->add($transport_road_minibus_stand_up);
        $this->add($transport_road_minibus_seating);

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