<?php
namespace Attraction\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class AttractionNewsForm extends Form
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
                'label' => 'Введите название достопримечательности для маршрутизации БЕЗ ПРОБЕЛОВ(Напр:для кафе "Апельсин" введите <b>apelsin</b>)(Текстовые данные)',
            ),
        ));

        $file = new Element\File('attraction_news_image');
        $file->setLabel('Загрузите главный рисунок новости')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $this->add(array(
            'name' => 'attraction_news_header',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'attraction_news_news',
                'placeholder' => 'Название достопримечательности',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите новость(Текстовые данные)',
            ),
        ));


        $this->add(array(
            'name' => 'attraction_news_news',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'attraction_news_news',
                'placeholder' => 'Название достопримечательности',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите новость(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'attraction_news_date',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'attraction_name',
                'placeholder' => 'Название достопримечательности',
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