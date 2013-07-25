<?php
    namespace Activity\Model;
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    use Zend\InputFilter\InputFilterAwareInterface;
    use Zend\InputFilter\InputFilterInterface;
    use Zend\InputFilter\FileInput;

    class Activity{
        public $activity_id;
        public $activity_id_name;
        public $activity_name;
        public $activity_type;
        public $activity_features;
        public $activity_main_photo;
        public $activity_photo_1;
        public $activity_photo_2;
        public $activity_photo_3;

        public $activity_time_work;
        public $activity_ticket_price;
        public $activity_telephone;
        public $activity_address;
        public $activity_description;
        public $activity_site;
        public $activity_longitude;
        public $activity_latitude;
        public $activity_vk;
        public $activity_facebook;
        public $activity_foursquare;

        protected $input_filter;

        public  function exchangeArray($data){
            $this->activity_id  = (!empty($data['activity_id'])) ? $data['activity_id'] : null;
            $this->activity_id_name  = (!empty($data['activity_id_name'])) ? $data['activity_id_name'] : null;
            $this->activity_name  = (!empty($data['activity_name'])) ? $data['activity_name'] : null;
            $this->activity_type  = (!empty($data['activity_type'])) ? $data['activity_type'] : null;
            $this->activity_features  = (!empty($data['activity_features'])) ? implode("-",array($data['activity_features'][0],$data['activity_features'][1],$data['activity_features'][2])) : null;
            if (!is_null($data['activity_main_photo']['tmp_name']))
            {
                $this->activity_main_photo = $data['activity_main_photo']['tmp_name'];
                $data['activity_main_photo']['tmp_name'] = null;

            }
            if (isset($data['activity_main_photo']['tmp_name'])){
                $this->activity_main_photo = $data['activity_main_photo'];
                $data['activity_main_photo']['tmp_name'] = null;

            }
            if (!is_null($data['activity_photo_1']['tmp_name']))
            {
                $this->activity_photo_1 = $data['activity_photo_1']['tmp_name'];
                $data['activity_photo_1']['tmp_name'] = null;

            }
            if (isset($data['activity_photo_1']['tmp_name'])){
                $this->activity_photo_1 = $data['activity_photo_1'];
                $data['activity_photo_1']['tmp_name'] = null;

            }
            if (!is_null($data['activity_photo_2']['tmp_name']))
            {
                $this->activity_photo_2 = $data['activity_photo_2']['tmp_name'];
                $data['activity_photo_2']['tmp_name'] = null;

            }
            if (isset($data['activity_photo_2']['tmp_name'])){
                $this->activity_photo_2 = $data['activity_photo_2'];
                $data['activity_photo_2']['tmp_name'] = null;

            }
            if (!is_null($data['activity_photo_3']['tmp_name']))
            {
                $this->activity_photo_3 = $data['activity_photo_3']['tmp_name'];
                $data['activity_photo_3']['tmp_name'] = null;

            }
            if (isset($data['activity_photo_3']['tmp_name'])){
                $this->activity_photo_3 = $data['activity_photo_3'];
                $data['activity_photo_3']['tmp_name'] = null;

            }
            $this->activity_time_work  = (!empty($data['activity_time_work'])) ? $data['activity_time_work'] : null;
            $this->activity_ticket_price  = (!empty($data['activity_ticket_price'])) ? $data['activity_ticket_price'] : null;
            $this->activity_telephone  = (!empty($data['activity_telephone'])) ? $data['activity_telephone'] : null;
            $this->activity_address  = (!empty($data['activity_address'])) ? $data['activity_address'] : null;
            $this->activity_description  = (!empty($data['activity_description'])) ? $data['activity_description'] : null;
            $this->activity_site = (!empty($data['activity_site'])) ? $data['activity_site'] : null;
            $this->activity_longitude  = (!empty($data['activity_longitude'])) ? $data['activity_longitude'] : null;
            $this->activity_latitude = (!empty($data['activity_latitude'])) ? $data['activity_latitude'] : null;
            $this->activity_vk  = (!empty($data['activity_vk'])) ? $data['activity_vk'] : null;
            $this->activity_facebook  = (!empty($data['activity_facebook'])) ? $data['activity_facebook'] : null;
            $this->activity_foursquare  = (!empty($data['activity_foursquare'])) ? $data['activity_foursquare'] : null;
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
                        'name'     => 'activity_id',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'Int'),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'activity_id_name',
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
                        'name'     => 'activity_name',
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
                        'name'     => 'activity_type',
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
                    $file = new FileInput('activity_main_photo');

                    $file->setRequired(true);
                    $file->getFilterChain()->attachByName(
                        'filerenameupload',
                        array(
                            'target'          => './yalta/img/activity/*',
                            'overwrite'       => true,
                            'use_upload_name' => true,
                        )
                    );
                   $inputFilter->add($file);
                $file = new FileInput('activity_photo_1');

                $file->setRequired(true);
                $file->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'          => './yalta/img/activity/*',
                        'overwrite'       => true,
                        'use_upload_name' => true,
                    )
                );
                $inputFilter->add($file);
                $file = new FileInput('activity_photo_2');

                $file->setRequired(true);
                $file->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'          => './yalta/img/activity/*',
                        'overwrite'       => true,
                        'use_upload_name' => true,
                    )
                );
                $inputFilter->add($file);
                $file = new FileInput('activity_photo_3');

                $file->setRequired(true);
                $file->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'          => './yalta/img/activity/*',
                        'overwrite'       => true,
                        'use_upload_name' => true,
                    )
                );
                $inputFilter->add($file);


                $inputFilter->add($factory->createInput(array(
                    'name' => 'activity_features',
                    'disable_inarray_validator' => false
                )));

                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'activity_time_work',
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
                        'name'     => 'activity_ticket_price',
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
                        'name'     => 'activity_telephone',
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
                        'name'     => 'activity_address',
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
                        'name'     => 'activity_description',
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
                        'name'     => 'activity_site',
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
                        'name'     => 'activity_longitude',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),

                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'activity_latitude',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),

                    )));


                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'activity_vk',
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
                    'name'     => 'activity_facebook',
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
                    'name'     => 'activity_foursquare',
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