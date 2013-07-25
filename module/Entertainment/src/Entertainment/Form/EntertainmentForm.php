<?php
namespace Entertainment\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class EntertainmentForm extends Form
{


    public function __construct($name = null)
    {
        $this->addElements();
    }
    public function addElements(){
        parent::__construct('entertainment');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'entertainment_id',
            'type' => 'Zend\Form\Element\Hidden',

        ));

        $this->add(array(
            'name' => 'entertainment_id_name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'entertainment_id_name',
                'placeholder' => 'Название развлечения',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите название развлечения для маршрутизации БЕЗ ПРОБЕЛОВ И ТОЛЬКО ЛАТИНИЦЕЙ(Напр:для кафе "Апельсин" введите <b>apelsin</b>)(Текстовые данные)',
            ),
        ));

        $this->add(array(
            'name' => 'entertainment_name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'entertainment_name',
                'placeholder' => 'Название развлечения',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите название развлечения(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'entertainment_type',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'entertainment_type',
                'placeholder' => 'Тип развлечения',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите тип развлечения(Напр: музей,церква)(Текстовые данные)',
            ),
        ));

        // File Input
        $file = new Element\File('entertainment_main_photo');
        $file->setLabel('Загрузите главный рисунок ресторана')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('entertainment_photo_1');
        $file->setLabel('Загрузите  рисунок ресторана')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('entertainment_photo_2');
        $file->setLabel('Загрузите рисунок ресторана')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('entertainment_photo_3');
        $file->setLabel('Загрузите  рисунок ресторана')
            ->setAttribute('id', 'image-file');
        $this->add($file);




        $this->add(array(
            'name' => 'entertainment_features',
            'type' => 'Zend\Form\Element\MultiCheckbox',

            'options' => array(
                'label' => 'Введите возможности развлечения',
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
            'name' => 'entertainment_time_work',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'entertainment_time_work',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите время работы развлечения',
            ),
        ));
//


        $this->add(array(
            'name' => 'entertainment_ticket_price',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'entertainment_ticket_price',
                'placeholder' => 'Цена билета для входа в развлечение',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Цена билета для входа в развлечение,если нету ставьте 0(Текстовые данные)',
            ),
        ));
//
//
        $this->add(array(
            'name' => 'entertainment_telephone',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'entertainment_telephone',
                'placeholder' => 'Контактный номер развлечения',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Укажите контактый номер развлечения(Текстовые данные)',
            ),
        ));
//
        $this->add(array(
            'name' => 'entertainment_address',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'entertainment_address',
                'placeholder' => 'Телефон адрес месторасположения',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Укажите адрес месторасположения развлечения(Текстовые данные)',
            ),
        ));

        $this->add(array(
            'name' => 'entertainment_description',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'id' => 'entertainment_description',
                'placeholder' => 'Описание ресторана?',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите описание развлечения(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'entertainment_site',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'restaurant_telephone',
                'placeholder' => 'Сайт развлечения?',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите сайт развлечения',
            ),
        ));
        $this->add(array(
            'name' => 'entertainment_longitude',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'address',
                'placeholder' => 'Широта',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите координаты развлечения:Широта.Напр:34.1140310(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'entertainment_latitude',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'entertainment_latitude',
                'placeholder' => 'Долгота',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите координаты развлечения:Долгота.Напр:44.4960330(Текстовые данные)',
            ),
        ));

                $this->add(array(
                    'name' => 'entertainment_vk',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'entertainment_vk',
                        'placeholder' => 'Введите сайт развлечения в соц.сети VK',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите сайт развлечения в соц.сети VK(Текстовые данные)',
                    ),
                ));
                $this->add(array(
                    'name' => 'entertainment_facebook',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'entertainment_facebook',
                        'placeholder' => 'Введите сайт развлечения в соц.сети Facebook',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите сайт развлечения в соц.сети Facebook(Текстовые данные)',
                    ),
                ));
                $this->add(array(
                'name' => 'entertainment_foursquare',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'id' => 'entertainment_foursquare',
                    'placeholder' => 'Введите сайт развлечения в соц.сети Foursquare',
                    'required' => 'required',
                ),
                'options' => array(
                    'label' => 'Введите сайт развлечения в соц.сети Foursquare(Текстовые данные)',
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