<?php
    namespace PrivateSector\Model;
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    use Zend\InputFilter\InputFilterAwareInterface;
    use Zend\InputFilter\InputFilterInterface;
    use Zend\InputFilter\FileInput;

    class PrivateSector{
        public $private_sector_id;
        public $private_sector_id_name;
        public $private_sector_name;
        public $private_sector_type;
        public $private_sector_features;
        public $private_sector_main_photo;
        public $private_sector_photo_1;
        public $private_sector_photo_2;
        public $private_sector_photo_3;

        public $private_sector_time_work;
        public $private_sector_ticket_price;
        public $private_sector_telephone;
        public $private_sector_address;
        public $private_sector_description;
        public $private_sector_site;
        public $private_sector_longitude;
        public $private_sector_latitude;
        public $private_sector_vk;
        public $private_sector_facebook;
        public $private_sector_foursquare;

        protected $input_filter;

        public  function exchangeArray($data){
            $this->private_sector_id  = (!empty($data['private_sector_id'])) ? $data['private_sector_id'] : null;
            $this->private_sector_id_name  = (!empty($data['private_sector_id_name'])) ? $data['private_sector_id_name'] : null;
            $this->private_sector_name  = (!empty($data['private_sector_name'])) ? $data['private_sector_name'] : null;
            $this->private_sector_type  = (!empty($data['private_sector_type'])) ? $data['private_sector_type'] : null;
            $this->private_sector_features  = (!empty($data['private_sector_features'])) ? implode("-",array($data['private_sector_features'][0],$data['private_sector_features'][1],$data['private_sector_features'][2])) : null;
            if (!is_null($data['private_sector_main_photo']['tmp_name']))
            {
                $this->private_sector_main_photo = $data['private_sector_main_photo']['tmp_name'];
                $data['private_sector_main_photo']['tmp_name'] = null;

            }
            if (isset($data['private_sector_main_photo']['tmp_name'])){
                $this->private_sector_main_photo = $data['private_sector_main_photo'];
                $data['private_sector_main_photo']['tmp_name'] = null;

            }
            if (!is_null($data['private_sector_photo_1']['tmp_name']))
            {
                $this->private_sector_photo_1 = $data['private_sector_photo_1']['tmp_name'];
                $data['private_sector_photo_1']['tmp_name'] = null;

            }
            if (isset($data['private_sector_photo_1']['tmp_name'])){
                $this->private_sector_photo_1 = $data['private_sector_photo_1'];
                $data['private_sector_photo_1']['tmp_name'] = null;

            }
            if (!is_null($data['private_sector_photo_2']['tmp_name']))
            {
                $this->private_sector_photo_2 = $data['private_sector_photo_2']['tmp_name'];
                $data['private_sector_photo_2']['tmp_name'] = null;

            }
            if (isset($data['private_sector_photo_2']['tmp_name'])){
                $this->private_sector_photo_2 = $data['private_sector_photo_2'];
                $data['private_sector_photo_2']['tmp_name'] = null;

            }
            if (!is_null($data['private_sector_photo_3']['tmp_name']))
            {
                $this->private_sector_photo_3 = $data['private_sector_photo_3']['tmp_name'];
                $data['private_sector_photo_3']['tmp_name'] = null;

            }
            if (isset($data['private_sector_photo_3']['tmp_name'])){
                $this->private_sector_photo_3 = $data['private_sector_photo_3'];
                $data['private_sector_photo_3']['tmp_name'] = null;

            }
            $this->private_sector_time_work  = (!empty($data['private_sector_time_work'])) ? $data['private_sector_time_work'] : null;
            $this->private_sector_ticket_price  = (!empty($data['private_sector_ticket_price'])) ? $data['private_sector_ticket_price'] : null;
            $this->private_sector_telephone  = (!empty($data['private_sector_telephone'])) ? $data['private_sector_telephone'] : null;
            $this->private_sector_address  = (!empty($data['private_sector_address'])) ? $data['private_sector_address'] : null;
            $this->private_sector_description  = (!empty($data['private_sector_description'])) ? $data['private_sector_description'] : null;
            $this->private_sector_site = (!empty($data['private_sector_site'])) ? $data['private_sector_site'] : null;
            $this->private_sector_longitude  = (!empty($data['private_sector_longitude'])) ? $data['private_sector_longitude'] : null;
            $this->private_sector_latitude = (!empty($data['private_sector_latitude'])) ? $data['private_sector_latitude'] : null;
            $this->private_sector_vk  = (!empty($data['private_sector_vk'])) ? $data['private_sector_vk'] : null;
            $this->private_sector_facebook  = (!empty($data['private_sector_facebook'])) ? $data['private_sector_facebook'] : null;
            $this->private_sector_foursquare  = (!empty($data['private_sector_foursquare'])) ? $data['private_sector_foursquare'] : null;
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
                        'name'     => 'private_sector_id',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'Int'),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'private_sector_id_name',
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
                        'name'     => 'private_sector_name',
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
                        'name'     => 'private_sector_type',
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
                    $file = new FileInput('private_sector_main_photo');

                    $file->setRequired(true);
                    $file->getFilterChain()->attachByName(
                        'filerenameupload',
                        array(
                            'target'          => './yalta/img/private_sector/*',
                            'overwrite'       => true,
                            'use_upload_name' => true,
                        )
                    );
                   $inputFilter->add($file);
                $file = new FileInput('private_sector_photo_1');

                $file->setRequired(true);
                $file->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'          => './yalta/img/private_sector/*',
                        'overwrite'       => true,
                        'use_upload_name' => true,
                    )
                );
                $inputFilter->add($file);
                $file = new FileInput('private_sector_photo_2');

                $file->setRequired(true);
                $file->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'          => './yalta/img/private_sector/*',
                        'overwrite'       => true,
                        'use_upload_name' => true,
                    )
                );
                $inputFilter->add($file);
                $file = new FileInput('private_sector_photo_3');

                $file->setRequired(true);
                $file->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'          => './yalta/img/private_sector/*',
                        'overwrite'       => true,
                        'use_upload_name' => true,
                    )
                );
                $inputFilter->add($file);


                $inputFilter->add($factory->createInput(array(
                    'name' => 'private_sector_features',
                    'disable_inarray_validator' => false
                )));

                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'private_sector_time_work',
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
                        'name'     => 'private_sector_ticket_price',
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
                        'name'     => 'private_sector_telephone',
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
                        'name'     => 'private_sector_address',
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
                        'name'     => 'private_sector_description',
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
                        'name'     => 'private_sector_site',
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
                        'name'     => 'private_sector_longitude',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),

                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'private_sector_latitude',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),

                    )));


                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'private_sector_vk',
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
                    'name'     => 'private_sector_facebook',
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
                    'name'     => 'private_sector_foursquare',
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