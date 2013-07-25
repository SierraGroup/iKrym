<?php
namespace Club\Model;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\FileInput;

class Club{

    public $club_id;

    public $club_id_name;
    public $club_name;
    public $club_description;
    public $club_thumbnail;
    public $club_image_1;
    public $club_image_2;
    public $club_image_3;

    public $club_average_account;
    public $club_directions;
    public $club_work_time;
    public $club_telephone;
    public $club_address;
    public $club_site;

    public $club_longitude;
    public $club_latitude;

    public $club_vk;
    public $club_facebook;
    public $club_foursquare;
    public $club_google_plus;

    public $club_features;

    protected $inputFilter;

    public  function exchangeArray($data){
        $this->club_id  = (!empty($data['club_id'])) ? $data['club_id'] : null;
        $this->club_id_name  = (!empty($data['club_id_name'])) ? $data['club_id_name'] : null;
        $this->club_name = (!empty($data['club_name'])) ? $data['club_name'] : null;
       // $this->restaurant_mode = (!empty($data['restaurant_mode'])) ? $data['restaurant_mode'] : null;
        $this->club_description = (!empty($data['club_description'])) ? $data['club_description'] : null;

        if (!is_null($data['club_thumbnail']['tmp_name']))
        {
            $this->club_thumbnail = $data['club_thumbnail']['tmp_name'];
            $data['club_thumbnail']['tmp_name'] = null;

        }
        if (isset($data['club_thumbnail']['tmp_name'])){
            $this->club_thumbnail = $data['club_thumbnail'];
            $data['club_thumbnail']['tmp_name'] = null;

        }

        if (!is_null($data['club_image_1']['tmp_name']))
        {
            $this->club_image_1 = $data['club_image_1']['tmp_name'];
            $data['club_image_1']['tmp_name'] = null;

        }
        if (isset($data['club_image_1']['tmp_name'])){
            $this->club_image_1 = $data['club_image_1'];
            $data['club_image_1']['tmp_name'] = null;

        }
        if (!is_null($data['club_image_2']['tmp_name']))
        {
            $this->club_image_2 = $data['club_image_2']['tmp_name'];
            $data['club_image_2']['tmp_name'] = null;

        }
        if (isset($data['club_image_2']['tmp_name'])){
            $this->club_image_2 = $data['club_image_2'];
            $data['club_image_2']['tmp_name'] = null;

        }
        if (!is_null($data['club_image_3']['tmp_name']))
        {
            $this->club_image_3 = $data['club_image_3']['tmp_name'];
            $data['club_image_3']['tmp_name'] = null;

        }
        if (isset($data['club_image_3']['tmp_name'])){
            $this->club_image_3 = $data['club_image_3'];
            $data['club_image_3']['tmp_name'] = null;

        }

        $this->club_average_account = (!empty($data['club_average_account'])) ? $data['club_average_account'] : null;
        $this->club_directions = (!empty($data['club_directions'])) ?  implode(" ",array($data['club_features'][0],$data['club_features'][1],$data['club_features'][2]))  : null;
        $this->club_work_time = (!empty($data['club_work_time'])) ? $data['club_work_time'] : null;
        $this->club_telephone = (!empty($data['club_telephone'])) ? $data['club_telephone'] : null;
        $this->club_address = (!empty($data['club_address'])) ? $data['club_address'] : null;
        $this->club_site = (!empty($data['club_site'])) ? $data['club_site'] : null;

        $this->club_longitude = (!empty($data['club_longitude'])) ? $data['club_longitude'] : null;
        $this->club_latitude = (!empty($data['club_latitude'])) ? $data['club_latitude'] : null;

        $this->club_vk = (!empty($data['club_vk'])) ? $data['club_vk'] : null;
        $this->club_facebook = (!empty($data['club_facebook'])) ? $data['club_facebook'] : null;
        $this->club_foursquare = (!empty($data['club_foursquare'])) ? $data['club_foursquare'] : null;
        $this->club_google_plus = (!empty($data['club_google_plus'])) ? $data['club_google_plus'] : null;


        $this->club_features= (!empty($data['club_features'])) ?  implode(" ",array($data['club_features'][0],$data['club_features'][1],$data['club_features'][2],$data['club_features'][3],$data['club_features'][4]))  : null;
    }
    public function getArrayCopy(){
        return get_object_vars($this);
    }
    public  function getInputFilter(){
        if(!$this->inputFilter){
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();
            $inputFilter->add($factory->createInput(array(
                'name'     => 'club_id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name' => 'club_id_name',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '1',
                            'max' => '100',
                        ),
                    ),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name' => 'club_name',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '1',
                            'max' => '100',
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'club_description',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '1',
                            'max' => '100',
                        ),
                    ),
                ),
            )));
            $file = new FileInput('club_thumbnail');

            $file->setRequired(true);
            $file->getFilterChain()->attachByName(
                'filerenameupload',
                array(
                    'target'          => './yalta/img/clubs/*',
                    'overwrite'       => true,
                    'use_upload_name' => true,
                )
            );
            $inputFilter->add($file);
            $file = new FileInput('club_image_1');

            $file->setRequired(true);
            $file->getFilterChain()->attachByName(
                'filerenameupload',
                array(
                    'target'          => './yalta/img/clubs/*',
                    'overwrite'       => true,
                    'use_upload_name' => true,
                )
            );
            $inputFilter->add($file);
            $file = new FileInput('club_image_2');

            $file->setRequired(true);
            $file->getFilterChain()->attachByName(
                'filerenameupload',
                array(
                    'target'          => './yalta/img/clubs/*',
                    'overwrite'       => true,
                    'use_upload_name' => true,
                )
            );
            $inputFilter->add($file);
            $file = new FileInput('club_image_3');

            $file->setRequired(true);
            $file->getFilterChain()->attachByName(
                'filerenameupload',
                array(
                    'target'          => './yalta/img/clubs/*',
                    'overwrite'       => true,
                    'use_upload_name' => true,
                )
            );
            $inputFilter->add($file);

            $inputFilter->add($factory->createInput(array(
                'name' => 'club_average_account',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '1',
                            'max' => '100',
                        ),
                    ),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name' => 'club_directions',
                'inarrayvalidator' => false,
            )));
            $inputFilter->add($factory->createInput(array(
                'name' => 'club_work_time',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '1',
                            'max' => '100',
                        ),
                    ),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name' => 'club_telephone',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '1',
                            'max' => '100',
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'club_address',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '1',
                            'max' => '100',
                        ),
                    ),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name' => 'club_site',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '1',
                            'max' => '100',
                        ),
                    ),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name'     => 'club_longitude',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),

            )));
            $inputFilter->add($factory->createInput(array(
                'name'     => 'club_latitude',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),

            )));
            $inputFilter->add($factory->createInput(array(
                'name' => 'club_vk',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '1',
                            'max' => '100',
                        ),
                    ),


                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name' => 'club_facebook',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '1',
                            'max' => '100',
                        ),
                    ),


                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name' => 'club_foursquare',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '1',
                            'max' => '100',
                        ),
                    ),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name' => 'club_google_plus',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array (
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => '1',
                            'max' => '100',
                        ),
                    ),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name' => 'club_features',
                'disable_inarray_validator' => false
            )));
            $this->inputFilter = $inputFilter;


        }
        return $this->inputFilter;
    }
}