<?php
        namespace Hostel\Model;
        use Zend\InputFilter\Factory as InputFactory;
        use Zend\InputFilter\InputFilterInterface;
        use Zend\InputFilter\InputFilter;
        use Zend\InputFilter\FileInput;

        class Hostel{

            public $hostel_id;
            public $hostel_id_name;
            public $hostel_name;
            public $hostel_image;
            public $hostel_photo_1;
            public $hostel_photo_2;
            public $hostel_photo_3;
            public $hostel_description;
            public $hostel_start_count;
            public $hostel_room_price;
            public $hostel_longitude;
            public $hostel_latitude;
            public $hostel_features;
            public $hostel_site;
            public $hostel_address;
            public $hostel_telephone;
            public $hostel_work_time;

            protected $inputFilter;

            public  function exchangeArray($data){
                       $this->hostel_id  = (!empty($data['hostel_id'])) ? $data['hostel_id'] : null;
                       $this->hostel_id_name = (!empty($data['hostel_id_name'])) ? $data['hostel_id_name'] : null;
                       $this->hostel_name = (!empty($data['hostel_name'])) ? $data['hostel_name'] : null;
                            if (!is_null($data['hostel_image']['tmp_name']))
                            {
                                $this->hostel_image = $data['hostel_image']['tmp_name'];
                                $data['hostel_image']['tmp_name'] = null;

                            }
                            if (isset($data['hostel_image']['tmp_name'])){
                                $this->hostel_image = $data['hostel_image'];
                                $data['hostel_image']['tmp_name'] = null;

                            }
                            if (!is_null($data['hostel_photo_1']['tmp_name']))
                            {
                                $this->hostel_photo_1= $data['hostel_photo_1']['tmp_name'];
                                $data['hostel_photo_1']['tmp_name'] = null;

                            }
                            if (isset($data['hostel_photo_1']['tmp_name'])){
                                $this->hostel_photo_1 = $data['hostel_image'];
                                $data['hostel_photo_1']['tmp_name'] = null;

                            }
                if (!is_null($data['hostel_photo_2']['tmp_name']))
                {
                    $this->hostel_photo_2 = $data['hostel_photo_2']['tmp_name'];
                    $data['hostel_photo_2']['tmp_name'] = null;

                }
                if (isset($data['hostel_photo_2']['tmp_name'])){
                    $this->hostel_photo_2 = $data['hostel_image'];
                    $data['hostel_photo_2']['tmp_name'] = null;

                }

                if (!is_null($data['hostel_photo_3']['tmp_name']))
                {
                    $this->hostel_photo_3 = $data['hostel_photo_3']['tmp_name'];
                    $data['hostel_photo_3']['tmp_name'] = null;

                }
                if (isset($data['hostel_photo_3']['tmp_name'])){
                    $this->hostel_photo_3 = $data['hostel_image'];
                    $data['hostel_photo_3']['tmp_name'] = null;

                }

                       $this->hostel_description = (!empty($data['hostel_description'])) ? $data['hostel_description'] : null;
                       $this->hostel_start_count = (!empty($data['hostel_start_count'])) ? $data['hostel_start_count'] : null;
                       $this->hostel_room_price = (!empty($data['hostel_room_price'])) ? $data['hostel_room_price'] : null;
                       $this->hostel_longitude = (!empty($data['hostel_longitude'])) ? $data['hostel_longitude'] : null;
                       $this->hostel_latitude = (!empty($data['hostel_latitude'])) ? $data['hostel_latitude'] : null;
                       $this->hostel_features = (!empty($data['hostel_features'])) ?  implode("  ",array( $data['hostel_features'][0],$data['hostel_features'][1],$data['hostel_features'][2],$data['hostel_features'][3],$data['hostel_features'][4],$data['hostel_features'][5],$data['hostel_features'][6],$data['hostel_features'][7]))  : null;
                       $this->hostel_site = (!empty($data['hostel_site'])) ? $data['hostel_site'] : null;
                       $this->hostel_address = (!empty($data['hostel_address'])) ? $data['hostel_address'] : null;
                       $this->hostel_telephone = (!empty($data['hostel_telephone'])) ? $data['hostel_telephone'] : null;
                       $this->hostel_work_time = (!empty($data['hostel_work_time'])) ? $data['hostel_work_time'] : null;

            }

            public function getArrayCopy(){
                return get_object_vars($this);
            }
            public  function getInputFilter(){
                    if(!$this->inputFilter){
                        $inputFilter = new InputFilter();
                        $factory     = new InputFactory();

                        //id
                        $inputFilter->add($factory->createInput(array(
                            'name'     => 'hostel_id',
                            'required' => true,
                            'filters'  => array(
                                array('name' => 'Int'),
                            ),
                        )));
                        //restaurant_id_name
                        $inputFilter->add($factory->createInput(array(
                            'name' => 'hostel_id_name',
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
                        //restaurant_name
                        $inputFilter->add($factory->createInput(array(
                            'name' => 'hostel_name',
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

                        // File Input
                        //https://github.com/cgmartin/ZF2FileUploadExamples/blob/master/src/ZF2FileUploadExamples/Form/SingleUpload.php
                        $file = new FileInput('hostel_image');

                        $file->setRequired(true);
                        $file->getFilterChain()->attachByName(
                            'filerenameupload',
                            array(
                                'target'          => './yalta/img/hostels/*',
                                'overwrite'       => true,
                                'use_upload_name' => true,
                            )
                        );
                        $inputFilter->add($file);

                        $file = new FileInput('hostel_photo_1');

                        $file->setRequired(true);
                        $file->getFilterChain()->attachByName(
                            'filerenameupload',
                            array(
                                'target'          => './yalta/img/hostels/*',
                                'overwrite'       => true,
                                'use_upload_name' => true,
                            )
                        );
                        $inputFilter->add($file);

                        $file = new FileInput('hostel_photo_2');

                        $file->setRequired(true);
                        $file->getFilterChain()->attachByName(
                            'filerenameupload',
                            array(
                                'target'          => './yalta/img/hostels/*',
                                'overwrite'       => true,
                                'use_upload_name' => true,
                            )
                        );
                        $inputFilter->add($file);

                        $file = new FileInput('hostel_photo_3');

                        $file->setRequired(true);
                        $file->getFilterChain()->attachByName(
                            'filerenameupload',
                            array(
                                'target'          => './yalta/img/hostels/*',
                                'overwrite'       => true,
                                'use_upload_name' => true,
                            )
                        );
                        $inputFilter->add($file);

                        //restaurant_description
                        $inputFilter->add($factory->createInput(array(
                            'name' => 'hostel_description',
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
                                        'max' => '1000',
                                    ),
                                ),
                            ),
                        )));
                        $inputFilter->add($factory->createInput(array(
                            'name'     => 'hostel_start_count',
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
                            'name'     => 'hostel_room_price',
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
                        //restaurant_thumbnail
//                        //restaurant_images
                        $inputFilter->add($factory->createInput(array(
                            'name' => 'hostel_longitude',
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
//                        //restaurant_average_account
                        $inputFilter->add($factory->createInput(array(
                            'name' => 'hostel_latitude',
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
                        //restaurant_directions
                        $inputFilter->add($factory->createInput(array(
                            'name' => 'hostel_features',
                            'disable_inarray_validator' => false

                        )));
                        //restaurant_work_time
                        $inputFilter->add($factory->createInput(array(
                            'name' => 'hostel_site',
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

                        //restaurant_telephone
                        $inputFilter->add($factory->createInput(array(
                            'name' => 'hostel_address',
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
                            'name' => 'hostel_telephone',
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
                            'name' => 'hostel_work_time',
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

                        $this->inputFilter = $inputFilter;

                    }
                    return $this->inputFilter;
            }
        }