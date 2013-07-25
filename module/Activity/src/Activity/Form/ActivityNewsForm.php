<?php
namespace Activity\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class ActivityNewsForm extends Form
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
                'label' => 'Введите название активного отдыха для маршрутизации БЕЗ ПРОБЕЛОВ(Напр:для кафе "Апельсин" введите <b>apelsin</b>)(Текстовые данные)',
            ),
        ));

        $file = new Element\File('activity_news_image');
        $file->setLabel('Загрузите главный рисунок новости')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $this->add(array(
            'name' => 'activity_news_header',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'activity_news_news',
                'placeholder' => 'Название активного отдыха',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите заголовок новость(Текстовые данные)',
            ),
        ));


        $this->add(array(
            'name' => 'activity_news_news',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'id' => 'activity_news_news',
                'placeholder' => 'Название активного отдыха',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите новость(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'activity_news_date',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'activity_name',
                'placeholder' => 'Название активного отдыха',
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