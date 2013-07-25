<?php
namespace PrivateSector\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class PrivateSectorForm extends Form
{


    public function __construct($name = null)
    {
        $this->addElements();
    }
    public function addElements(){
        parent::__construct('private_sector');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'private_sector_id',
            'type' => 'Zend\Form\Element\Hidden',

        ));

        $this->add(array(
            'name' => 'private_sector_id_name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'private_sector_id_name',
                'placeholder' => 'Название частного сектора',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите название частного сектора для маршрутизации БЕЗ ПРОБЕЛОВ И ТОЛЬКО ЛАТИНИЦЕЙ(Напр:для кафе "Апельсин" введите <b>apelsin</b>)(Текстовые данные)',
            ),
        ));

        $this->add(array(
            'name' => 'private_sector_name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'private_sector_name',
                'placeholder' => 'Название частного сектора',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите название частного сектора(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'private_sector_type',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'private_sector_type',
                'placeholder' => 'Тип частного сектора',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите тип частного сектора(Напр: парк,школа танцев,студия)(Текстовые данные)',
            ),
        ));

        // File Input
        $file = new Element\File('private_sector_main_photo');
        $file->setLabel('Загрузите главный рисунок частного сектора')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('private_sector_photo_1');
        $file->setLabel('Загрузите  рисунок частного сектора')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('private_sector_photo_2');
        $file->setLabel('Загрузите рисунок частного сектора')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('private_sector_photo_3');
        $file->setLabel('Загрузите  рисунок частного сектора')
            ->setAttribute('id', 'image-file');
        $this->add($file);




        $this->add(array(
            'name' => 'private_sector_features',
            'type' => 'Zend\Form\Element\MultiCheckbox',

            'options' => array(
                'label' => 'Введите возможности частного сектора',
                'label_attributes' => array(
                    'id' => 'direction',
                ),
                'setRegisterInArrayValidator' => false,
                'value_options' => array(
                    'Коорпоративные мероприятия' => 'Коорпоративные мероприятия',
                    'Персональные тренировки' => 'Персональные тренировки',
                    'Бильярд' => 'Билярд',
                    'Место для курения' => 'Место для курения',
                    'Кафе/Бар' => 'Кафе/Бар',
                    'Парковка' => 'Парковка',
                    'Бронирование' => 'Бронирование',
                    'Прокат оборудования' => 'Прокат оборудования',

                ),
            ),
            //http://zend-framework-community.634137.n4.nabble.com/The-input-was-not-found-in-the-haystack-td4657596.html
            'attributes' => array(
                'inarrayvalidator' => false,
            ),
        ));
//
        $this->add(array(
            'name' => 'private_sector_time_work',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'private_sector_time_work',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите время работы частного сектора',
            ),
        ));
//


        $this->add(array(
            'name' => 'private_sector_ticket_price',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'private_sector_ticket_price',
                'placeholder' => 'Цена билета для входа в частный сектор',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Цена билета для входа в частный сектор,если нету ставьте 0(Текстовые данные)',
            ),
        ));
//
//
        $this->add(array(
            'name' => 'private_sector_telephone',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'private_sector_telephone',
                'placeholder' => 'Контактный номер частного сектора',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Укажите контактый номер частного сектора(Текстовые данные)',
            ),
        ));
//
        $this->add(array(
            'name' => 'private_sector_address',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'private_sector_address',
                'placeholder' => 'Телефон адрес месторасположения',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Укажите адрес месторасположения частного сектора(Текстовые данные)',
            ),
        ));

        $this->add(array(
            'name' => 'private_sector_description',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'id' => 'private_sector_description',
                'placeholder' => 'Описание частного сектора?',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите описание частного сектора(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'private_sector_site',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'restaurant_telephone',
                'placeholder' => 'Сайт частного сектора?',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите сайт частного сектора',
            ),
        ));
        $this->add(array(
            'name' => 'private_sector_longitude',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'address',
                'placeholder' => 'Широта',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите координаты частного сектора:Широта.Напр:34.1140310(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'private_sector_latitude',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'private_sector_latitude',
                'placeholder' => 'Долгота',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите координаты частного сектора:Долгота.Напр:44.4960330(Текстовые данные)',
            ),
        ));

                $this->add(array(
                    'name' => 'private_sector_vk',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'private_sector_vk',
                        'placeholder' => 'Введите сайт частного сектора в соц.сети VK',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите сайт частного сектора в соц.сети VK(Текстовые данные)',
                    ),
                ));
                $this->add(array(
                    'name' => 'private_sector_facebook',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'private_sector_facebook',
                        'placeholder' => 'Введите сайт частного сектора в соц.сети Facebook',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите сайт частного сектора в соц.сети Facebook(Текстовые данные)',
                    ),
                ));
                $this->add(array(
                'name' => 'private_sector_foursquare',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id' => 'private_sector_foursquare',
                    'placeholder' => 'Введите сайт частного сектора в соц.сети Foursquare',
                    'required' => 'required',
                ),
                'options' => array(
                    'label' => 'Введите сайт частного сектора в соц.сети Foursquare(Текстовые данные)',
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