<?php
        namespace Hostel\Form;

        use Zend\Captcha;
        use Zend\Form\Element;
        use Zend\Form\Form;

        class HostelForm extends Form
        {

            public function __construct($name = null)
            {
                parent::__construct('hostel');

                $this->setAttribute('method', 'post');

                $this->add(array(
                    'name' => 'hostel_id',
                    'type' => 'Zend\Form\Element\Hidden',

                ));

                $this->add(array(
                    'name' => 'hostel_id_name',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'hostel_id_name',
                        'placeholder' => 'Введите название гостиницы для маршутизации по сайту',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите название гостиницы для маршутизации по сайту!Ввод только английскими буквами',
                    ),
                ));
                $this->add(array(
                    'name' => 'hostel_name',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'hostel_name',
                        'placeholder' => 'Введите название гостиницы для маршутизации по сайту',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите название гостиницы',
                    ),
                ));

                // File Input
                $file = new Element\File('hostel_image');
                $file->setLabel('Загрузите главный рисунок ресторана')
                    ->setAttribute('id', 'image-file');
                $this->add($file);

                // File Input
                $file = new Element\File('hostel_photo_1');
                $file->setLabel('Загрузите рисунок ресторана')
                    ->setAttribute('id', 'image-file');
                $this->add($file);

                // File Input
                $file = new Element\File('hostel_photo_2');
                $file->setLabel('Загрузите рисунок ресторана')
                    ->setAttribute('id', 'image-file');
                $this->add($file);

                // File Input
                $file = new Element\File('hostel_photo_3');
                $file->setLabel('Загрузите  рисунок ресторана')
                    ->setAttribute('id', 'image-file');
                $this->add($file);


                $this->add(array(
                    'name' => 'hostel_description',
                    'type' => 'Zend\Form\Element\Textarea',
                    'attributes' => array(
                        'id' => 'hostel_description',
                        'placeholder' => 'Тип ресторана',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите описание гостиницы',
                    ),
                ));
//
                $this->add(array(
                    'name' => 'hostel_start_count',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'restaurant_start_count',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите количевство звёзд  для гостиницы(1-5)',
                    ),
                ));

                $this->add(array(
                    'name' => 'hostel_room_price',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'hostel_room_price',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите cтоимость номера для гостиницы( в грн)',
                    ),
                ));


                $this->add(array(
                    'name' => 'hostel_longitude',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'hostel_longitude',
                        'placeholder' => 'Введите координаты  Долгота (Текстовые данные).Например:34.164321',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите координаты гостиницы Долгота (Текстовые данные).Например:34.164321',
                    ),
                ));
//
//
                $this->add(array(
                    'name' => 'hostel_latitude',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'hostel_longitude',
                        'placeholder' => 'Введите координаты  Широта (Текстовые данные).Например:44.490152',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите координаты гостиницы Широта (Текстовые данные).Например:44.490152',
                    ),
                ));
//
                $this->add(array(
                    'name' => 'hostel_features',
                    'type' => 'Zend\Form\Element\MultiCheckbox',

                    'options' => array(
                        'label' => 'Введите услуги для гостиниц',
                        'label_attributes' => array(
                            'id' => 'direction',
                        ),
                        'setRegisterInArrayValidator' => false,
                        'value_options' => array(
                            'Wi-fi' => 'Wi-fi',
                            'Сейф' => 'Сейф',
                            'Паркинг' => 'Паркинг',
                            'Бронирование' => 'Бронирование',
                            'Заказ еды' => 'Заказ еды',
                            'Бар в номере' => 'Бар в номере',
                            'Visa/Master Card' =>'Visa/Master Card'

                        ),
                    ),
                    //http://zend-framework-community.634137.n4.nabble.com/The-input-was-not-found-in-the-haystack-td4657596.html

                ));
                $this->add(array(
                    'name' => 'hostel_site',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'hostel_site',
                        'placeholder' => 'Введите адрес сайта',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите cайт гостиницы',
                    ),
                ));
                $this->add(array(
                    'name' => 'hostel_address',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'hostel_address',
                        'placeholder' => 'Введите адрес гостиницы',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите адрес гостиницы',
                    ),
                ));
                $this->add(array(
                    'name' => 'hostel_telephone',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'hostel_address',
                        'placeholder' => 'Введите телефон гостиницы',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите телефон гостиницы',
                    ),
                ));
                $this->add(array(
                    'name' => 'hostel_work_time',
                    'type' => 'Zend\Form\Element\Text',
                    'attributes' => array(
                        'id' => 'hostel_work_time',
                        'placeholder' => 'Введите рабочее время гостиницы',
                        'required' => 'required',
                    ),
                    'options' => array(
                        'label' => 'Введите время работы гостиницы',
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