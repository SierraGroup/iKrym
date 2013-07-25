<?php
namespace Attraction\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class AttractionForm extends Form
{


    public function __construct($name = null)
    {
        $this->addElements();
    }
    public function addElements(){
        parent::__construct('attraction');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'attraction_id',
            'type' => 'Zend\Form\Element\Hidden',

        ));

        $this->add(array(
            'name' => 'attraction_id_name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'attraction_id_name',
                'placeholder' => 'Название достопримечательности',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите название достопримечательности для маршрутизации БЕЗ ПРОБЕЛОВ И ТОЛЬКО ЛАТИНИЦЕЙ(Напр:для кафе "Апельсин" введите <b>apelsin</b>)(Текстовые данные)',
            ),
        ));

        $this->add(array(
            'name' => 'attraction_name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'attraction_name',
                'placeholder' => 'Название достопримечательности',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите название достопримечательности(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'attraction_type',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'attraction_type',
                'placeholder' => 'Тип достопримечательности',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите тип достопримечательности(Напр: музей,церква)(Текстовые данные)',
            ),
        ));

        // File Input
        $file = new Element\File('attraction_main_photo');
        $file->setLabel('Загрузите главный рисунок ресторана')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('attraction_photo_1');
        $file->setLabel('Загрузите  рисунок ресторана')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('attraction_photo_2');
        $file->setLabel('Загрузите рисунок ресторана')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('attraction_photo_3');
        $file->setLabel('Загрузите  рисунок ресторана')
            ->setAttribute('id', 'image-file');
        $this->add($file);




        $this->add(array(
            'name' => 'attraction_features',
            'type' => 'Zend\Form\Element\MultiCheckbox',

            'options' => array(
                'label' => 'Введите возможности достопримечательности',
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
//
        $this->add(array(
            'name' => 'attraction_time_work',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'attraction_time_work',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите время работы достопримечательности',
            ),
        ));
//


        $this->add(array(
            'name' => 'attraction_ticket_price',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'attraction_ticket_price',
                'placeholder' => 'Цена билета для входа в достопримечательность',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Цена билета для входа в достопримечательность,если нету ставьте 0(Текстовые данные)',
            ),
        ));
//
//
        $this->add(array(
            'name' => 'attraction_telephone',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'attraction_telephone',
                'placeholder' => 'Контактный номер достопримечательности',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Укажите контактый номер достопримечательности(Текстовые данные)',
            ),
        ));
//
        $this->add(array(
            'name' => 'attraction_address',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'attraction_address',
                'placeholder' => 'Телефон адрес месторасположения',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Укажите адрес месторасположения достопримечательности(Текстовые данные)',
            ),
        ));

        $this->add(array(
            'name' => 'attraction_description',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'id' => 'attraction_description',
                'placeholder' => 'Описание ресторана?',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите описание достопримечательности(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'attraction_site',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'restaurant_telephone',
                'placeholder' => 'Сайт достопримечательности?',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите сайт достопримечательности',
            ),
        ));
        $this->add(array(
            'name' => 'attraction_longitude',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'address',
                'placeholder' => 'Широта',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите координаты достопримечательности:Широта.Напр:34.1140310(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'attraction_latitude',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'attraction_latitude',
                'placeholder' => 'Долгота',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите координаты достопримечательности:Долгота.Напр:44.4960330(Текстовые данные)',
            ),
        ));

                $this->add(array(
                    'name' => 'attraction_vk',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'attraction_vk',
                        'placeholder' => 'Введите сайт достопримечательности в соц.сети VK',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите сайт достопримечательности в соц.сети VK(Текстовые данные)',
                    ),
                ));
                $this->add(array(
                    'name' => 'attraction_facebook',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'attraction_facebook',
                        'placeholder' => 'Введите сайт достопримечательности в соц.сети Facebook',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите сайт достопримечательности в соц.сети Facebook(Текстовые данные)',
                    ),
                ));
                $this->add(array(
                'name' => 'attraction_foursquare',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id' => 'attraction_foursquare',
                    'placeholder' => 'Введите сайт достопримечательности в соц.сети Foursquare',
                    'required' => 'required',
                ),
                'options' => array(
                    'label' => 'Введите сайт достопримечательности в соц.сети Foursquare(Текстовые данные)',
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