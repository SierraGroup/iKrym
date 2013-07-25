<?php
namespace Hostel\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class HostelNewsForm extends Form
{
    public function __construct($name = null)
    {
        $this->addElements();
    }
    public function addElements(){
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
                'placeholder' => 'Название достопримечательности',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите название достопримечательности для маршрутизации БЕЗ ПРОБЕЛОВ(Напр:для кафе "Апельсин" введите <b>apelsin</b>)(Текстовые данные)',
            ),
        ));

        $file = new Element\File('hostel_news_image');
        $file->setLabel('Загрузите главный рисунок новости')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $this->add(array(
            'name' => 'hostel_news_header',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'hostel_news_news',
                'placeholder' => 'Название достопримечательности',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите новость(Текстовые данные)',
            ),
        ));


        $this->add(array(
            'name' => 'hostel_news_news',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'hostel_news_news',
                'placeholder' => 'Название достопримечательности',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите новость(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'hostel_news_date',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'hostel_name',
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