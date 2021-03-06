<?php
namespace Activity\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class ActivityForm extends Form
{


    public function __construct($name = null)
    {
        $this->addElements();
    }
    public function addElements(){
        parent::__construct('activity');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'activity_id',
            'type' => 'Zend\Form\Element\Hidden',

        ));

        $this->add(array(
            'name' => 'activity_id_name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'activity_id_name',
                'placeholder' => 'Название активного отдыха',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите название активного отдыха для маршрутизации БЕЗ ПРОБЕЛОВ И ТОЛЬКО ЛАТИНИЦЕЙ(Напр:для кафе "Апельсин" введите <b>apelsin</b>)(Текстовые данные)',
            ),
        ));

        $this->add(array(
            'name' => 'activity_name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'activity_name',
                'placeholder' => 'Название активного отдыха',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите название активного отдыха(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'activity_type',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'activity_type',
                'placeholder' => 'Тип активного отдыха',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите тип активного отдыха(Напр: парк,школа танцев,студия)(Текстовые данные)',
            ),
        ));

        // File Input
        $file = new Element\File('activity_main_photo');
        $file->setLabel('Загрузите главный рисунок активного отдыха')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('activity_photo_1');
        $file->setLabel('Загрузите  рисунок активного отдыха')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('activity_photo_2');
        $file->setLabel('Загрузите рисунок активного отдыха')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('activity_photo_3');
        $file->setLabel('Загрузите  рисунок активного отдыха')
            ->setAttribute('id', 'image-file');
        $this->add($file);




        $this->add(array(
            'name' => 'activity_features',
            'type' => 'Zend\Form\Element\MultiCheckbox',

            'options' => array(
                'label' => 'Введите возможности активного отдыха',
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
            'name' => 'activity_time_work',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'activity_time_work',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите время работы активного отдыха',
            ),
        ));
//


        $this->add(array(
            'name' => 'activity_ticket_price',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'activity_ticket_price',
                'placeholder' => 'Цена билета для входа в активный отдых',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Цена билета для входа в активный отдых,если нету ставьте 0(Текстовые данные)',
            ),
        ));
//
//
        $this->add(array(
            'name' => 'activity_telephone',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'activity_telephone',
                'placeholder' => 'Контактный номер активного отдыха',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Укажите контактый номер активного отдыха(Текстовые данные)',
            ),
        ));
//
        $this->add(array(
            'name' => 'activity_address',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'activity_address',
                'placeholder' => 'Телефон адрес месторасположения',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Укажите адрес месторасположения активного отдыха(Текстовые данные)',
            ),
        ));

        $this->add(array(
            'name' => 'activity_description',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'id' => 'activity_description',
                'placeholder' => 'Описание активного отдыха?',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите описание активного отдыха(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'activity_site',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'restaurant_telephone',
                'placeholder' => 'Сайт активного отдыха?',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите сайт активного отдыха',
            ),
        ));
        $this->add(array(
            'name' => 'activity_longitude',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'address',
                'placeholder' => 'Широта',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите координаты активного отдыха:Широта.Напр:34.1140310(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'activity_latitude',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'activity_latitude',
                'placeholder' => 'Долгота',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите координаты активного отдыха:Долгота.Напр:44.4960330(Текстовые данные)',
            ),
        ));

                $this->add(array(
                    'name' => 'activity_vk',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'activity_vk',
                        'placeholder' => 'Введите сайт активного отдыха в соц.сети VK',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите сайт активного отдыха в соц.сети VK(Текстовые данные)',
                    ),
                ));
                $this->add(array(
                    'name' => 'activity_facebook',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'activity_facebook',
                        'placeholder' => 'Введите сайт активного отдыха в соц.сети Facebook',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите сайт активного отдыха в соц.сети Facebook(Текстовые данные)',
                    ),
                ));
                $this->add(array(
                'name' => 'activity_foursquare',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id' => 'activity_foursquare',
                    'placeholder' => 'Введите сайт активного отдыха в соц.сети Foursquare',
                    'required' => 'required',
                ),
                'options' => array(
                    'label' => 'Введите сайт активного отдыха в соц.сети Foursquare(Текстовые данные)',
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