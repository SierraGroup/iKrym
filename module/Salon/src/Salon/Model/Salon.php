<?php
    namespace Salon\Model;
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    use Zend\InputFilter\InputFilterAwareInterface;
    use Zend\InputFilter\InputFilterInterface;
    use Zend\InputFilter\FileInput;

    class Salon{
        public $salon_id;
        public $salon_id_name;
        public $salon_name;

        public $salon_features;
        public $salon_time_work;
        public $salon_ticket_price;
        public $salon_telephone;
        public $salon_address;
        public $salon_description;
        public $salon_site;
        public $salon_longitude;
        public $salon_latitude;

        public $salon_foursquare;


        public $salon_main_photo;
        public $salon_photo_1;
        public $salon_photo_2;
        public $salon_photo_3;

        public $salon_vk;
        public $salon_facebook;



        protected $input_filter;

        public  function exchangeArray($data){
            $this->salon_id  = (!empty($data['salon_id'])) ? $data['salon_id'] : null;
            $this->salon_id_name  = (!empty($data['salon_id_name'])) ? $data['salon_id_name'] : null;
            $this->salon_name  = (!empty($data['salon_name'])) ? $data['salon_name'] : null;
            $this->salon_type  = (!empty($data['salon_type'])) ? $data['salon_type'] : null;
            $this->salon_features  = (!empty($data['salon_features'])) ? implode("-",array($data['salon_features'][0],$data['salon_features'][1],$data['salon_features'][2])) : null;
            if (!is_null($data['salon_main_photo']['tmp_name']))
            {
                $this->salon_main_photo = $data['salon_main_photo']['tmp_name'];
                $data['salon_main_photo']['tmp_name'] = null;

            }
            if (isset($data['salon_main_photo']['tmp_name'])){
                $this->salon_main_photo = $data['salon_main_photo'];
                $data['salon_main_photo']['tmp_name'] = null;

            }
            if (!is_null($data['salon_photo_1']['tmp_name']))
            {
                $this->salon_photo_1 = $data['salon_photo_1']['tmp_name'];
                $data['salon_photo_1']['tmp_name'] = null;

            }
            if (isset($data['salon_photo_1']['tmp_name'])){
                $this->salon_photo_1 = $data['salon_photo_1'];
                $data['salon_photo_1']['tmp_name'] = null;

            }
            if (!is_null($data['salon_photo_2']['tmp_name']))
            {
                $this->salon_photo_2 = $data['salon_photo_2']['tmp_name'];
                $data['salon_photo_2']['tmp_name'] = null;

            }
            if (isset($data['salon_photo_2']['tmp_name'])){
                $this->salon_photo_2 = $data['salon_photo_2'];
                $data['salon_photo_2']['tmp_name'] = null;

            }
            if (!is_null($data['salon_photo_3']['tmp_name']))
            {
                $this->salon_photo_3 = $data['salon_photo_3']['tmp_name'];
                $data['salon_photo_3']['tmp_name'] = null;

            }
            if (isset($data['salon_photo_3']['tmp_name'])){
                $this->salon_photo_3 = $data['salon_photo_3'];
                $data['salon_photo_3']['tmp_name'] = null;

            }
            $this->salon_time_work  = (!empty($data['salon_time_work'])) ? $data['salon_time_work'] : null;
            $this->salon_ticket_price  = (!empty($data['salon_ticket_price'])) ? $data['salon_ticket_price'] : null;
            $this->salon_telephone  = (!empty($data['salon_telephone'])) ? $data['salon_telephone'] : null;
            $this->salon_address  = (!empty($data['salon_address'])) ? $data['salon_address'] : null;
            $this->salon_description  = (!empty($data['salon_description'])) ? $data['salon_description'] : null;
            $this->salon_site = (!empty($data['salon_site'])) ? $data['salon_site'] : null;
            $this->salon_longitude  = (!empty($data['salon_longitude'])) ? $data['salon_longitude'] : null;
            $this->salon_latitude = (!empty($data['salon_latitude'])) ? $data['salon_latitude'] : null;
            $this->salon_vk  = (!empty($data['salon_vk'])) ? $data['salon_vk'] : null;
            $this->salon_facebook  = (!empty($data['salon_facebook'])) ? $data['salon_facebook'] : null;
            $this->salon_foursquare  = (!empty($data['salon_foursquare'])) ? $data['salon_foursquare'] : null;
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
                        'name'     => 'salon_id',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'Int'),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'salon_id_name',
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
                        'name'     => 'salon_name',
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
                    $file = new FileInput('salon_main_photo');

                    $file->setRequired(true);
                    $file->getFilterChain()->attachByName(
                        'filerenameupload',
                        array(
                            'target'          => './yalta/img/salon/*',
                            'overwrite'       => true,
                            'use_upload_name' => true,
                        )
                    );
                   $inputFilter->add($file);
                $file = new FileInput('salon_photo_1');

                $file->setRequired(true);
                $file->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'          => './yalta/img/salon/*',
                        'overwrite'       => true,
                        'use_upload_name' => true,
                    )
                );
                $inputFilter->add($file);
                $file = new FileInput('salon_photo_2');

                $file->setRequired(true);
                $file->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'          => './yalta/img/salon/*',
                        'overwrite'       => true,
                        'use_upload_name' => true,
                    )
                );
                $inputFilter->add($file);
                $file = new FileInput('salon_photo_3');

                $file->setRequired(true);
                $file->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'          => './yalta/img/salon/*',
                        'overwrite'       => true,
                        'use_upload_name' => true,
                    )
                );
                $inputFilter->add($file);


                $inputFilter->add($factory->createInput(array(
                    'name' => 'salon_features',
                    'disable_inarray_validator' => false
                )));

                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'salon_time_work',
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
                        'name'     => 'salon_ticket_price',
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
                        'name'     => 'salon_telephone',
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
                        'name'     => 'salon_address',
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
                        'name'     => 'salon_description',
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
                        'name'     => 'salon_site',
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
                        'name'     => 'salon_longitude',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),

                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'salon_latitude',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),

                    )));


                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'salon_vk',
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
                    'name'     => 'salon_facebook',
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
                    'name'     => 'salon_foursquare',
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