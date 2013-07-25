<?php
    namespace Entertainment\Model;
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    use Zend\InputFilter\InputFilterAwareInterface;
    use Zend\InputFilter\InputFilterInterface;
    use Zend\InputFilter\FileInput;

    class Entertainment{
        public $entertainment_id;
        public $entertainment_id_name;
        public $entertainment_name;
        public $entertainment_type;
        public $entertainment_features;
        public $entertainment_main_photo;
        public $entertainment_photo_1;
        public $entertainment_photo_2;
        public $entertainment_photo_3;

        public $entertainment_time_work;
        public $entertainment_ticket_price;
        public $entertainment_telephone;
        public $entertainment_address;
        public $entertainment_description;
        public $entertainment_site;
        public $entertainment_longitude;
        public $entertainment_latitude;
        public $entertainment_vk;
        public $entertainment_facebook;
        public $entertainment_foursquare;

        protected $input_filter;

        public  function exchangeArray($data){
            $this->entertainment_id  = (!empty($data['entertainment_id'])) ? $data['entertainment_id'] : null;
            $this->entertainment_id_name  = (!empty($data['entertainment_id_name'])) ? $data['entertainment_id_name'] : null;
            $this->entertainment_name  = (!empty($data['entertainment_name'])) ? $data['entertainment_name'] : null;
            $this->entertainment_type  = (!empty($data['entertainment_type'])) ? $data['entertainment_type'] : null;
            $this->entertainment_features  = (!empty($data['entertainment_features'])) ? implode("-",array($data['entertainment_features'][0],$data['entertainment_features'][1],$data['entertainment_features'][2])) : null;
            if (!is_null($data['entertainment_main_photo']['tmp_name']))
            {
                $this->entertainment_main_photo = $data['entertainment_main_photo']['tmp_name'];
                $data['entertainment_main_photo']['tmp_name'] = null;

            }
            if (isset($data['entertainment_main_photo']['tmp_name'])){
                $this->entertainment_main_photo = $data['entertainment_main_photo'];
                $data['entertainment_main_photo']['tmp_name'] = null;

            }
            if (!is_null($data['entertainment_photo_1']['tmp_name']))
            {
                $this->entertainment_photo_1 = $data['entertainment_photo_1']['tmp_name'];
                $data['entertainment_photo_1']['tmp_name'] = null;

            }
            if (isset($data['entertainment_photo_1']['tmp_name'])){
                $this->entertainment_photo_1 = $data['entertainment_photo_1'];
                $data['entertainment_photo_1']['tmp_name'] = null;

            }
            if (!is_null($data['entertainment_photo_2']['tmp_name']))
            {
                $this->entertainment_photo_2 = $data['entertainment_photo_2']['tmp_name'];
                $data['entertainment_photo_2']['tmp_name'] = null;

            }
            if (isset($data['entertainment_photo_2']['tmp_name'])){
                $this->entertainment_photo_2 = $data['entertainment_photo_2'];
                $data['entertainment_photo_2']['tmp_name'] = null;

            }
            if (!is_null($data['entertainment_photo_3']['tmp_name']))
            {
                $this->entertainment_photo_3 = $data['entertainment_photo_3']['tmp_name'];
                $data['entertainment_photo_3']['tmp_name'] = null;

            }
            if (isset($data['entertainment_photo_3']['tmp_name'])){
                $this->entertainment_photo_3 = $data['entertainment_photo_3'];
                $data['entertainment_photo_3']['tmp_name'] = null;

            }
            $this->entertainment_time_work  = (!empty($data['entertainment_time_work'])) ? $data['entertainment_time_work'] : null;
            $this->entertainment_ticket_price  = (!empty($data['entertainment_ticket_price'])) ? $data['entertainment_ticket_price'] : null;
            $this->entertainment_telephone  = (!empty($data['entertainment_telephone'])) ? $data['entertainment_telephone'] : null;
            $this->entertainment_address  = (!empty($data['entertainment_address'])) ? $data['entertainment_address'] : null;
            $this->entertainment_description  = (!empty($data['entertainment_description'])) ? $data['entertainment_description'] : null;
            $this->entertainment_site = (!empty($data['entertainment_site'])) ? $data['entertainment_site'] : null;
            $this->entertainment_longitude  = (!empty($data['entertainment_longitude'])) ? $data['entertainment_longitude'] : null;
            $this->entertainment_latitude = (!empty($data['entertainment_latitude'])) ? $data['entertainment_latitude'] : null;
            $this->entertainment_vk  = (!empty($data['entertainment_vk'])) ? $data['entertainment_vk'] : null;
            $this->entertainment_facebook  = (!empty($data['entertainment_facebook'])) ? $data['entertainment_facebook'] : null;
            $this->entertainment_foursquare  = (!empty($data['entertainment_foursquare'])) ? $data['entertainment_foursquare'] : null;
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
                        'name'     => 'entertainment_id',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'Int'),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'entertainment_id_name',
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
                                    'max'      => 300,
                                ),
                            ),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'entertainment_name',
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
                                    'max'      => 300,
                                ),
                            ),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'entertainment_type',
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
                                    'max'      => 300,
                                ),
                            ),
                        ),
                    )));
                    // File Input
                    //https://github.com/cgmartin/ZF2FileUploadExamples/blob/master/src/ZF2FileUploadExamples/Form/SingleUpload.php
                    $file = new FileInput('entertainment_main_photo');

                    $file->setRequired(true);
                    $file->getFilterChain()->attachByName(
                        'filerenameupload',
                        array(
                            'target'          => './yalta/img/entertainment/*',
                            'overwrite'       => true,
                            'use_upload_name' => true,
                        )
                    );
                   $inputFilter->add($file);
                $file = new FileInput('entertainment_photo_1');

                $file->setRequired(true);
                $file->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'          => './yalta/img/entertainment/*',
                        'overwrite'       => true,
                        'use_upload_name' => true,
                    )
                );
                $inputFilter->add($file);
                $file = new FileInput('entertainment_photo_2');

                $file->setRequired(true);
                $file->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'          => './yalta/img/entertainment/*',
                        'overwrite'       => true,
                        'use_upload_name' => true,
                    )
                );
                $inputFilter->add($file);
                $file = new FileInput('entertainment_photo_3');

                $file->setRequired(true);
                $file->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'          => './yalta/img/entertainment/*',
                        'overwrite'       => true,
                        'use_upload_name' => true,
                    )
                );
                $inputFilter->add($file);


                $inputFilter->add($factory->createInput(array(
                    'name' => 'entertainment_features',
                    'disable_inarray_validator' => false
                )));

                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'entertainment_time_work',
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
                                    'max'      => 300,
                                ),
                            ),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'entertainment_ticket_price',
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
                                    'max'      => 300,
                                ),
                            ),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'entertainment_telephone',
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
                                    'max'      => 300,
                                ),
                            ),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'entertainment_address',
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
                                    'max'      => 300,
                                ),
                            ),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'entertainment_description',
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
                        'name'     => 'entertainment_site',
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
                                    'max'      => 3000,
                                ),
                            ),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'entertainment_longitude',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),

                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'entertainment_latitude',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),

                    )));


                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'entertainment_vk',
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
                                    'max'      => 3000,
                                ),
                            ),
                        ),
                     )));
                    $inputFilter->add($factory->createInput(array(
                    'name'     => 'entertainment_facebook',
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
                                'max'      => 3000,
                            ),
                        ),
                    ),
                )));
                $inputFilter->add($factory->createInput(array(
                    'name'     => 'entertainment_foursquare',
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
                                'max'      => 3000,
                            ),
                        ),
                    ),
                )));
                $this->input_filter = $inputFilter;
        }
            return $this->input_filter;
        }
    }