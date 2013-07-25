<?php
namespace Restaurant\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class RestaurantNewsForm extends Form
{
    public function __construct($name = null)
    {
        $this->addElements();
    }
    public function addElements(){
        parent::__construct('restaurant_news');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'restaurant_news_id',
            'type' => 'Zend\Form\Element\Hidden',

        ));
        $this->add(array(
            'name' => 'restaurant_news_timestamp',
            'type' => 'Zend\Form\Element\Hidden',

        ));

        $this->add(array(
            'name' => 'restaurant_id_name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'restaurant_id_name',
                'placeholder' => 'Название ресторана',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите название ресторана для маршрутизации БЕЗ ПРОБЕЛОВ(Напр:для кафе "Апельсин" введите <b>apelsin</b>)(Текстовые данные)',
            ),
        ));

        $file = new Element\File('restaurant_news_image');
        $file->setLabel('Загрузите главный рисунок новости ресторана')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $this->add(array(
            'name' => 'restaurant_news_header',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'restaurant_news_news',
                'placeholder' => 'Название достопримечательности',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите заголовок новости ресторана(Текстовые данные)',
            ),
        ));


        $this->add(array(
            'name' => 'restaurant_news_news',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'restaurant_news_news',
                'placeholder' => 'Название ресторана',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите новость ресторана(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'restaurant_news_date',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'restaurant_name',
                'placeholder' => 'Дата создание новости',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите дату создания новости(Текстовые данные)',
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