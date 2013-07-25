<?php
namespace Salon\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class SalonForm extends Form
{


    public function __construct($name = null)
    {
        $this->addElements();
    }
    public function addElements(){
        parent::__construct('salon');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'salon_id',
            'type' => 'Zend\Form\Element\Hidden',

        ));

        $this->add(array(
            'name' => 'salon_id_name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'salon_id_name',
                'placeholder' => 'Название салона',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите название салона для маршрутизации БЕЗ ПРОБЕЛОВ И ТОЛЬКО ЛАТИНИЦЕЙ(Напр:для кафе "Апельсин" введите <b>apelsin</b>)(Текстовые данные)',
            ),
        ));

        $this->add(array(
            'name' => 'salon_name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'salon_name',
                'placeholder' => 'Название салона',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите название салона(Текстовые данные)',
            ),
        ));


        // File Input
        $file = new Element\File('salon_main_photo');
        $file->setLabel('Загрузите главный рисунок ресторана')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('salon_photo_1');
        $file->setLabel('Загрузите  рисунок ресторана')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('salon_photo_2');
        $file->setLabel('Загрузите рисунок ресторана')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('salon_photo_3');
        $file->setLabel('Загрузите  рисунок ресторана')
            ->setAttribute('id', 'image-file');
        $this->add($file);




        $this->add(array(
            'name' => 'salon_features',
            'type' => 'Zend\Form\Element\MultiCheckbox',

            'options' => array(
                'label' => 'Введите возможности салона',
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
            'name' => 'salon_time_work',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'salon_time_work',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите время работы салона',
            ),
        ));
//


        $this->add(array(
            'name' => 'salon_ticket_price',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'salon_ticket_price',
                'placeholder' => 'Цена билета для входа в салон',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Цена билета для входа в салон,если нету ставьте 0(Текстовые данные)',
            ),
        ));
//
//
        $this->add(array(
            'name' => 'salon_telephone',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'salon_telephone',
                'placeholder' => 'Контактный номер салона',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Укажите контактый номер салона(Текстовые данные)',
            ),
        ));
//
        $this->add(array(
            'name' => 'salon_address',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'salon_address',
                'placeholder' => 'Телефон адрес месторасположения',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Укажите адрес месторасположения салона(Текстовые данные)',
            ),
        ));

        $this->add(array(
            'name' => 'salon_description',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'id' => 'salon_description',
                'placeholder' => 'Описание ресторана?',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите описание салона(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'salon_site',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'restaurant_telephone',
                'placeholder' => 'Сайт салона?',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите сайт салона',
            ),
        ));
        $this->add(array(
            'name' => 'salon_longitude',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'address',
                'placeholder' => 'Широта',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите координаты салона:Широта.Напр:34.1140310(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'salon_latitude',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'salon_latitude',
                'placeholder' => 'Долгота',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите координаты салона:Долгота.Напр:44.4960330(Текстовые данные)',
            ),
        ));

                $this->add(array(
                    'name' => 'salon_vk',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'salon_vk',
                        'placeholder' => 'Введите сайт салона в соц.сети VK',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите сайт салона в соц.сети VK(Текстовые данные)',
                    ),
                ));
                $this->add(array(
                    'name' => 'salon_facebook',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'salon_facebook',
                        'placeholder' => 'Введите сайт салона в соц.сети Facebook',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите сайт салона в соц.сети Facebook(Текстовые данные)',
                    ),
                ));
                $this->add(array(
                'name' => 'salon_foursquare',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id' => 'salon_foursquare',
                    'placeholder' => 'Введите сайт салона в соц.сети Foursquare',
                    'required' => 'required',
                ),
                'options' => array(
                    'label' => 'Введите сайт салона в соц.сети Foursquare(Текстовые данные)',
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