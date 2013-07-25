<?php
namespace Cafe\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class CafeForm extends Form
{

    public function __construct($name = null)
    {
        parent::__construct('cafe');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'cafe_id',
            'type' => 'Zend\Form\Element\Hidden',

        ));

        $this->add(array(
            'name' => 'cafe_id_name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'cafe_id_name',
                'placeholder' => 'Название кафе',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите название кафе для маршрутизации(Напр:для кафе "Апельсин" введите apelsin)(Текстовые данные)',
            ),
        ));

        $this->add(array(
            'name' => 'cafe_name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'cafe_name',
                'placeholder' => 'Название кафе',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите название кафе(Текстовые данные)',
            ),
        ));

        $this->add(array(
            'name' => 'cafe_description',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'id' => 'cafe_description',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите описание кафе(Текстовые данные)',
            ),
        ));

//                // File Input
        $file = new Element\File('cafe_thumbnail');
        $file->setLabel('Загрузите главный рисунок кафе')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('cafe_image_1');
        $file->setLabel('Загрузите рисунок кафе')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('cafe_image_2');
        $file->setLabel('Загрузите рисунок кафе')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('cafe_image_3');
        $file->setLabel('Загрузите рисунок кафе')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $this->add(array(
            'name' => 'cafe_average_account',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'cafe_average_account',
                'placeholder' => 'Средняя стоимость услуг кафе',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Укажите среднюю стоимость услуг кафе(Текстовые данные)',
            ),
        ));
//
        $this->add(array(
            'name' => 'cafe_directions',
            'type' => 'Zend\Form\Element\MultiCheckbox',

            'options' => array(
                'label' => 'Введите тип кафе',
                'label_attributes' => array(
                    'id' => 'cafe_directions',
                ),
                'setRegisterInArrayValidator' => false,
                'value_options' => array(
                    'Шансон' => 'Шансон',
                    'Ретро' => 'Ретро',
                    'Танцевальная музыка' => 'Танцевальная музыка',
                    'Електронная музыка' => 'Електронная музыка'
                ),
            ),
            //http://zend-framework-community.634137.n4.nabble.com/The-input-was-not-found-in-the-haystack-td4657596.html
            'attributes' => array(
                'inarrayvalidator' => false,
            ),
        ));
        $this->add(array(
            'name' => 'cafe_work_time',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'cafe_work_time',
                'placeholder' => 'Время работы кафе',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Укажите время работы кафе(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'cafe_telephone',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'cafe_telephone',
                'placeholder' => 'Телефон кафе',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите номер телефона кафе',
            ),
        ));
        $this->add(array(
            'name' => 'cafe_address',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'cafe_address',
                'placeholder' => 'Адрес кафе',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите адрес кафе(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'cafe_site',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'cafe_site',
                'placeholder' => 'Адрес сайта кафе',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите адрес сайта кафе(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'cafe_longitude',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'cafe_longitude',
                'placeholder' => 'Координаты кафе:долгота',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите координаты  кафе Долгота (Текстовые данные).Например:34.164321',
            ),
        ));
        $this->add(array(
            'name' => 'cafe_latitude',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'cafe_latitude',
                'placeholder' => 'Координаты кафе:ширина',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите координаты кафе:Широта(Текстовые данные).Например:44.490152',
            ),
        ));
        $this->add(array(
            'name' => 'cafe_vk',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'cafe_vk',
                'placeholder' => 'Введите сайт кафе в соц.сети VK',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите сайт кафе в соц.сети VK(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'cafe_facebook',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'cafe_facebook',
                'placeholder' => 'Введите сайт кафе в соц.сети Facebook',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите сайт кафе в соц.сети Facebook(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'cafe_foursquare',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'cafe_foursquare',
                'placeholder' => 'Введите сайт кафе в соц.сети Foursquare',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите сайт кафе в соц.сети Foursquare(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'cafe_google_plus',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'cafe_google_plus',
                'placeholder' => 'Введите сайт кафе в соц.сети Google Plus',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите сайт  кафе в соц.сети Google Plus(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'cafe_features',
            'type' => 'Zend\Form\Element\MultiCheckbox',

            'options' => array(
                'label' => 'Введите возможности кафе',
                'label_attributes' => array(
                    'id' => 'cafe_features',
                ),
                'setRegisterInArrayValidator' => false,
                'value_options' => array(
                    'DJ' => 'DJ',
                    'Wi-fi' => 'Wi-fi',
                    'Кальян' => 'Кальян',
                    'Живая музыка' => 'Живая музыка',
                    'Караоке' => 'Караоке'
                ),
            ),
            //http://zend-framework-community.634137.n4.nabble.com/The-input-was-not-found-in-the-haystack-td4657596.html
            'attributes' => array(
                'inarrayvalidator' => false,
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