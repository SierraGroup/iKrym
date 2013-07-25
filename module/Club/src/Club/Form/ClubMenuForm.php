<?php
namespace Club\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class ClubMenuForm extends Form
{
    public function __construct($name = null)
    {
        $this->addElements();
    }
    public function addElements(){
        parent::__construct('club_menu');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'club_menu_id',
            'type' => 'Zend\Form\Element\Hidden',

        ));

        $this->add(array(
            'name' => 'club_id_name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'attraction_id_name',
                'placeholder' => 'Название меню',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите название клубаё для маршрутизации БЕЗ ПРОБЕЛОВ И ТОЛЬКО ЛАТИНИЦЕЙ(Напр:для кафе "Апельсин" введите <b>apelsin</b>)(Текстовые данные)',
            ),
        ));

        $file = new Element\File('club_menu_type_image');
        $file->setLabel('Загрузите главный рисунок меню клуба')
            ->setAttribute('id', 'image-file');
        $this->add($file);

        $this->add(array(
            'name' => 'club_menu_type',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'attraction_news_news',
                'placeholder' => 'Название меню',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Введите название меню клуба(супы,напитки,салатики)(Текстовые данные)',
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