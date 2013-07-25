<?php
namespace Club\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class ClubForm extends Form
{

    public function __construct($name = null)
    {
        parent::__construct('club');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'club_id',
            'type' => 'Zend\Form\Element\Hidden',

        ));

        $this->add(array(
            'name' => 'club_id_name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'club_id_name',
                'placeholder' => 'Название клуба',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите название клуба для маршрутизации(Напр:для кафе "Апельсин" введите apelsin)(Текстовые данные)',
            ),
        ));

        $this->add(array(
            'name' => 'club_name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'club_name',
                'placeholder' => 'Название клуба',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите название клуба(Текстовые данные)',
            ),
        ));

        $this->add(array(
            'name' => 'club_description',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'id' => 'club_description',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите описание клуба(Текстовые данные)',
            ),
        ));

//                // File Input
        $file = new Element\File('club_thumbnail');
        $file->setLabel('Загрузите главный рисунок кафе')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('club_image_1');
        $file->setLabel('Загрузите рисунок кафе')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('club_image_2');
        $file->setLabel('Загрузите рисунок кафе')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $file = new Element\File('club_image_3');
        $file->setLabel('Загрузите рисунок кафе')
            ->setAttribute('id', 'image-file');
        $this->add($file);



//
        $this->add(array(
            'name' => 'club_average_account',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'club_average_account',
                'placeholder' => 'Средняя стоимость услуг клуба',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Укажите среднюю стоимость услуг клуба(Текстовые данные)',
            ),
        ));
//
        $this->add(array(
            'name' => 'club_directions',
            'type' => 'Zend\Form\Element\MultiCheckbox',

            'options' => array(
                'label' => 'Введите тип клуба',
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
            'name' => 'club_work_time',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'club_work_time',
                'placeholder' => 'Время работы клуба',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Укажите время работы клуба(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'club_telephone',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'club_telephone',
                'placeholder' => 'Телефон клуба',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите номер телефона клуба',
            ),
        ));
        $this->add(array(
            'name' => 'club_address',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'club_address',
                'placeholder' => 'Адрес клуба',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите адрес клуба(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'club_site',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'club_site',
                'placeholder' => 'Адрес сайта клуба',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите адрес сайта клуба(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'club_longitude',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'club_longitude',
                'placeholder' => 'Координаты клуба:долгота',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите координаты  клуба Долгота (Текстовые данные).Например:34.164321',
            ),
        ));
        $this->add(array(
            'name' => 'club_latitude',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'club_latitude',
                'placeholder' => 'Координаты клуба:ширина',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите координаты клуба:Широта(Текстовые данные).Например:44.490152',
            ),
        ));
        $this->add(array(
            'name' => 'club_vk',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'club_vk',
                'placeholder' => 'Введите сайт клуба в соц.сети VK',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите сайт клуба в соц.сети VK(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'club_facebook',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'club_facebook',
                'placeholder' => 'Введите сайт клуба в соц.сети Facebook',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите сайт клуба в соц.сети Facebook(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'club_foursquare',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'club_foursquare',
                'placeholder' => 'Введите сайт клуба в соц.сети Foursquare',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите сайт клуба в соц.сети Foursquare(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'club_google_plus',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'club_google_plus',
                'placeholder' => 'Введите сайт клуба в соц.сети Google Plus',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите сайт  клуба в соц.сети Google Plus(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'club_features',
            'type' => 'Zend\Form\Element\MultiCheckbox',

            'options' => array(
                'label' => 'Введите возможности клуба',
                'label_attributes' => array(
                    'id' => 'club_features',
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