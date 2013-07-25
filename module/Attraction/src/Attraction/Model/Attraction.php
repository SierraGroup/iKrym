<?php
    namespace Attraction\Model;
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    use Zend\InputFilter\InputFilterAwareInterface;
    use Zend\InputFilter\InputFilterInterface;
    use Zend\InputFilter\FileInput;

    class Attraction{
        public $attraction_id;
        public $attraction_id_name;
        public $attraction_name;
        public $attraction_type;
        public $attraction_features;
        public $attraction_main_photo;

//        public $attraction_dj;
//        public $attraction_wifi;
//        public $attraction_karaoke;
//        public $attraction_kalian;
//        public $attraction_chill_out;
//        public $attraction_sigarette_room;
//        public $attraction_veranda;


        public $attraction_photo_1;
        public $attraction_photo_2;
        public $attraction_photo_3;

        public $attraction_time_work;
        public $attraction_ticket_price;
        public $attraction_telephone;
        public $attraction_address;
        public $attraction_description;
        public $attraction_site;
        public $attraction_longitude;
        public $attraction_latitude;
        public $attraction_vk;
        public $attraction_facebook;
        public $attraction_foursquare;

        protected $input_filter;

        public  function exchangeArray($data){
            $this->attraction_id  = (!empty($data['attraction_id'])) ? $data['attraction_id'] : null;
            $this->attraction_id_name  = (!empty($data['attraction_id_name'])) ? $data['attraction_id_name'] : null;
            $this->attraction_name  = (!empty($data['attraction_name'])) ? $data['attraction_name'] : null;
            $this->attraction_type  = (!empty($data['attraction_type'])) ? $data['attraction_type'] : null;
            $this->attraction_features  = (!empty($data['attraction_features'])) ? implode("-",array($data['attraction_features'][0],$data['attraction_features'][1],$data['attraction_features'][2])) : null;
            if (!is_null($data['attraction_main_photo']['tmp_name']))
            {
                $this->attraction_main_photo = $data['attraction_main_photo']['tmp_name'];
                $data['attraction_main_photo']['tmp_name'] = null;

            }
            if (isset($data['attraction_main_photo']['tmp_name'])){
                $this->attraction_main_photo = $data['attraction_main_photo'];
                $data['attraction_main_photo']['tmp_name'] = null;

            }
            if (!is_null($data['attraction_photo_1']['tmp_name']))
            {
                $this->attraction_photo_1 = $data['attraction_photo_1']['tmp_name'];
                $data['attraction_photo_1']['tmp_name'] = null;

            }
            if (isset($data['attraction_photo_1']['tmp_name'])){
                $this->attraction_photo_1 = $data['attraction_photo_1'];
                $data['attraction_photo_1']['tmp_name'] = null;

            }
            if (!is_null($data['attraction_photo_2']['tmp_name']))
            {
                $this->attraction_photo_2 = $data['attraction_photo_2']['tmp_name'];
                $data['attraction_photo_2']['tmp_name'] = null;

            }
            if (isset($data['attraction_photo_2']['tmp_name'])){
                $this->attraction_photo_2 = $data['attraction_photo_2'];
                $data['attraction_photo_2']['tmp_name'] = null;

            }
            if (!is_null($data['attraction_photo_3']['tmp_name']))
            {
                $this->attraction_photo_3 = $data['attraction_photo_3']['tmp_name'];
                $data['attraction_photo_3']['tmp_name'] = null;

            }
            if (isset($data['attraction_photo_3']['tmp_name'])){
                $this->attraction_photo_3 = $data['attraction_photo_3'];
                $data['attraction_photo_3']['tmp_name'] = null;

            }
            $this->attraction_time_work  = (!empty($data['attraction_time_work'])) ? $data['attraction_time_work'] : null;
            $this->attraction_ticket_price  = (!empty($data['attraction_ticket_price'])) ? $data['attraction_ticket_price'] : null;
            $this->attraction_telephone  = (!empty($data['attraction_telephone'])) ? $data['attraction_telephone'] : null;
            $this->attraction_address  = (!empty($data['attraction_address'])) ? $data['attraction_address'] : null;
            $this->attraction_description  = (!empty($data['attraction_description'])) ? $data['attraction_description'] : null;
            $this->attraction_site = (!empty($data['attraction_site'])) ? $data['attraction_site'] : null;
            $this->attraction_longitude  = (!empty($data['attraction_longitude'])) ? $data['attraction_longitude'] : null;
            $this->attraction_latitude = (!empty($data['attraction_latitude'])) ? $data['attraction_latitude'] : null;
            $this->attraction_vk  = (!empty($data['attraction_vk'])) ? $data['attraction_vk'] : null;
            $this->attraction_facebook  = (!empty($data['attraction_facebook'])) ? $data['attraction_facebook'] : null;
            $this->attraction_foursquare  = (!empty($data['attraction_foursquare'])) ? $data['attraction_foursquare'] : null;
        }
        public  function getArrayCopy(){
            //Gets the properties of the given object
            return get_object_vars($this);
        }
        public  function getInputFilter(){
            if(!$this->input_filter){
                    $inputFilter = new InputFilter();
                    $factory     = new InputFactory();
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'attraction_id',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'Int'),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'attraction_id_name',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name'    => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min'      => 1,
                                    'max'      => 100,
                                ),
                            ),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'attraction_name',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name'    => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min'      => 1,
                                    'max'      => 100,
                                ),
                            ),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'attraction_type',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name'    => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min'      => 1,
                                    'max'      => 100,
                                ),
                            ),
                        ),
                    )));
                    // File Input
                    //https://github.com/cgmartin/ZF2FileUploadExamples/blob/master/src/ZF2FileUploadExamples/Form/SingleUpload.php
                    $file = new FileInput('attraction_main_photo');

                    $file->setRequired(true);
                    $file->getFilterChain()->attachByName(
                        'filerenameupload',
                        array(
                            'target'          => './yalta/img/attraction/*',
                            'overwrite'       => true,
                            'use_upload_name' => true,
                        )
                    );
                   $inputFilter->add($file);
                $file = new FileInput('attraction_photo_1');

                $file->setRequired(true);
                $file->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'          => './yalta/img/attraction/*',
                        'overwrite'       => true,
                        'use_upload_name' => true,
                    )
                );
                $inputFilter->add($file);
                $file = new FileInput('attraction_photo_2');

                $file->setRequired(true);
                $file->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'          => './yalta/img/attraction/*',
                        'overwrite'       => true,
                        'use_upload_name' => true,
                    )
                );
                $inputFilter->add($file);
                $file = new FileInput('attraction_photo_3');

                $file->setRequired(true);
                $file->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'          => './yalta/img/attraction/*',
                        'overwrite'       => true,
                        'use_upload_name' => true,
                    )
                );
                $inputFilter->add($file);


                $inputFilter->add($factory->createInput(array(
                    'name' => 'attraction_features',
                    'disable_inarray_validator' => false
                )));

                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'attraction_time_work',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name'    => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min'      => 1,
                                    'max'      => 100,
                                ),
                            ),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'attraction_ticket_price',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name'    => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min'      => 0,
                                    'max'      => 100,
                                ),
                            ),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'attraction_telephone',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name'    => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min'      => 1,
                                    'max'      => 100,
                                ),
                            ),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'attraction_address',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name'    => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min'      => 1,
                                    'max'      => 100,
                                ),
                            ),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'attraction_description',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name'    => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min'      => 1,
                                    'max'      => 2000,
                                ),
                            ),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'attraction_site',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name'    => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min'      => 1,
                                    'max'      => 1000,
                                ),
                            ),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'attraction_longitude',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),

                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'attraction_latitude',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),

                    )));


                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'attraction_vk',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name'    => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min'      => 1,
                                    'max'      => 1000,
                                ),
                            ),
                        ),
                     )));
                    $inputFilter->add($factory->createInput(array(
                    'name'     => 'attraction_facebook',
                    'required' => true,
                    'filters'  => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                        array(
                            'name'    => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 1000,
                            ),
                        ),
                    ),
                )));
                $inputFilter->add($factory->createInput(array(
                    'name'     => 'attraction_foursquare',
                    'required' => true,
                    'filters'  => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                        array(
                            'name'    => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 1000,
                            ),
                        ),
                    ),
                )));
                $this->input_filter = $inputFilter;
        }
            return $this->input_filter;
        }
    }