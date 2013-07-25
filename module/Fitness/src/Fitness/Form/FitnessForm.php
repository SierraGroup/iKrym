<?php
namespace Fitness\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class FitnessForm extends Form
{


    public function __construct($name = null)
    {
        $this->addElements();
    }
    public function addElements(){
        parent::__construct('fitness');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'fitness_id',
            'type' => 'Zend\Form\Element\Hidden',

        ));

        $this->add(array(
            'name' => 'fitness_id_name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'fitness_id_name',
                'placeholder' => 'Название фитнес-центра',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите название фитнес-центра для маршрутизации БЕЗ ПРОБЕЛОВ И ТОЛЬКО ЛАТИНИЦЕЙ(Напр:для кафе "Апельсин" введите <b>apelsin</b>)(Текстовые данные)',
            ),
        ));

        $this->add(array(
            'name' => 'fitness_name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'fitness_name',
                'placeholder' => 'Название фитнес-центра',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите название фитнес-центра(Текстовые данные)',
            ),
        ));


        // File Input
        $file = new Element\File('fitness_main_photo');
        $file->setLabel('Загрузите главный рисунок ресторана')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('fitness_photo_1');
        $file->setLabel('Загрузите  рисунок ресторана')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('fitness_photo_2');
        $file->setLabel('Загрузите рисунок ресторана')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('fitness_photo_3');
        $file->setLabel('Загрузите  рисунок ресторана')
            ->setAttribute('id', 'image-file');
        $this->add($file);




        $this->add(array(
            'name' => 'fitness_features',
            'type' => 'Zend\Form\Element\MultiCheckbox',

            'options' => array(
                'label' => 'Введите возможности фитнес-центра',
                'label_attributes' => array(
                    'id' => 'direction',
                ),
                'setRegisterInArrayValidator' => false,
                'value_options' => array(
                    'Бесплатный вход' => 'Бесплатный вход',
                    'Тур' => 'Тур',
                    'Екскурсия по городу' => 'Екскурсия по городу',
                ),
            ),
            //http://zend-framework-community.634137.n4.nabble.com/The-input-was-not-found-in-the-haystack-td4657596.html
            'attributes' => array(
                'inarrayvalidator' => false,
            ),
        ));
//ё


        $this->add(array(
            'name' => 'fitness_time_work',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'fitness_time_work',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите время работы фитнес-центра',
            ),
        ));
//


        $this->add(array(
            'name' => 'fitness_ticket_price',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'fitness_ticket_price',
                'placeholder' => 'Цена билета для входа в фитнес-центр',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Цена билета для входа в фитнес-центр,если нету ставьте 0(Текстовые данные)',
            ),
        ));
//
//
        $this->add(array(
            'name' => 'fitness_telephone',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'fitness_telephone',
                'placeholder' => 'Контактный номер фитнес-центра',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Укажите контактый номер фитнес-центра(Текстовые данные)',
            ),
        ));
//
        $this->add(array(
            'name' => 'fitness_address',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'fitness_address',
                'placeholder' => 'Телефон адрес месторасположения',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Укажите адрес месторасположения фитнес-центра(Текстовые данные)',
            ),
        ));

        $this->add(array(
            'name' => 'fitness_description',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'id' => 'fitness_description',
                'placeholder' => 'Описание ресторана?',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите описание фитнес-центра(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'fitness_site',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'restaurant_telephone',
                'placeholder' => 'Сайт фитнес-центра?',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите сайт фитнес-центра',
            ),
        ));
        $this->add(array(
            'name' => 'fitness_longitude',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'address',
                'placeholder' => 'Широта',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите координаты фитнес-центра:Широта.Напр:34.1140310(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'fitness_latitude',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'fitness_latitude',
                'placeholder' => 'Долгота',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите координаты фитнес-центра:Долгота.Напр:44.4960330(Текстовые данные)',
            ),
        ));

                $this->add(array(
                    'name' => 'fitness_vk',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'fitness_vk',
                        'placeholder' => 'Введите сайт фитнес-центра в соц.сети VK',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите сайт фитнес-центра в соц.сети VK(Текстовые данные)',
                    ),
                ));
                $this->add(array(
                    'name' => 'fitness_facebook',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'fitness_facebook',
                        'placeholder' => 'Введите сайт фитнес-центра в соц.сети Facebook',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите сайт фитнес-центра в соц.сети Facebook(Текстовые данные)',
                    ),
                ));
                $this->add(array(
                'name' => 'fitness_foursquare',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id' => 'fitness_foursquare',
                    'placeholder' => 'Введите сайт фитнес-центра в соц.сети Foursquare',
                    'required' => 'required',
                ),
                'options' => array(
                    'label' => 'Введите сайт фитнес-центра в соц.сети Foursquare(Текстовые данные)',
                ),
            ));


        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',

            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}