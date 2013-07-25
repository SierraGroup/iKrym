<?php
namespace Club\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class ClubPosterForm extends Form
{
    public function __construct($name = null)
    {
        $this->addElements();
    }
    public function addElements(){
        parent::__construct('club_poster');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'club_poster_id',
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
                'label' => 'Введите название клуба для маршрутизации БЕЗ ПРОБЕЛОВ(Напр:для кафе "Апельсин" введите <b>apelsin</b>)(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'club_poster_name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'club_news_news',
                'placeholder' => 'Название клуба',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите имя постера(Текстовые данные)',
            ),
        ));

        $file = new Element\File('club_poster_image');
        $file->setLabel('Загрузите главный рисунок клуба')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $this->add(array(
            'name' => 'club_poster_header',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'club_news_news',
                'placeholder' => 'Название клуба',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите заголовок афишы(Текстовые данные)',
            ),
        ));


        $this->add(array(
            'name' => 'club_poster_date',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'club_poster_date',
                'placeholder' => 'Название достопримечательности',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите дату создания афишы(Текстовые данные)',
            ),
        ));
        $this->add(array(
            'name' => 'club_poster_description',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'id' => 'club_poster_description',
                'placeholder' => 'Назвите описание афишы',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите описание афишы(Текстовые данные)',
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