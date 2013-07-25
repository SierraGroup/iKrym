<?php
    namespace Fitness\Model;
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    use Zend\InputFilter\InputFilterAwareInterface;
    use Zend\InputFilter\InputFilterInterface;
    use Zend\InputFilter\FileInput;

    class Fitness{
        public $fitness_id;
        public $fitness_id_name;
        public $fitness_name;

        public $fitness_features;
        public $fitness_time_work;
        public $fitness_ticket_price;
        public $fitness_telephone;
        public $fitness_address;
        public $fitness_description;
        public $fitness_site;
        public $fitness_longitude;
        public $fitness_latitude;

        public $fitness_foursquare;


        public $fitness_main_photo;
        public $fitness_photo_1;
        public $fitness_photo_2;
        public $fitness_photo_3;

        public $fitness_vk;
        public $fitness_facebook;



        protected $input_filter;

        public  function exchangeArray($data){
            $this->fitness_id  = (!empty($data['fitness_id'])) ? $data['fitness_id'] : null;
            $this->fitness_id_name  = (!empty($data['fitness_id_name'])) ? $data['fitness_id_name'] : null;
            $this->fitness_name  = (!empty($data['fitness_name'])) ? $data['fitness_name'] : null;
            $this->fitness_type  = (!empty($data['fitness_type'])) ? $data['fitness_type'] : null;
            $this->fitness_features  = (!empty($data['fitness_features'])) ? implode("-",array($data['fitness_features'][0],$data['fitness_features'][1],$data['fitness_features'][2])) : null;
            if (!is_null($data['fitness_main_photo']['tmp_name']))
            {
                $this->fitness_main_photo = $data['fitness_main_photo']['tmp_name'];
                $data['fitness_main_photo']['tmp_name'] = null;

            }
            if (isset($data['fitness_main_photo']['tmp_name'])){
                $this->fitness_main_photo = $data['fitness_main_photo'];
                $data['fitness_main_photo']['tmp_name'] = null;

            }
            if (!is_null($data['fitness_photo_1']['tmp_name']))
            {
                $this->fitness_photo_1 = $data['fitness_photo_1']['tmp_name'];
                $data['fitness_photo_1']['tmp_name'] = null;

            }
            if (isset($data['fitness_photo_1']['tmp_name'])){
                $this->fitness_photo_1 = $data['fitness_photo_1'];
                $data['fitness_photo_1']['tmp_name'] = null;

            }
            if (!is_null($data['fitness_photo_2']['tmp_name']))
            {
                $this->fitness_photo_2 = $data['fitness_photo_2']['tmp_name'];
                $data['fitness_photo_2']['tmp_name'] = null;

            }
            if (isset($data['fitness_photo_2']['tmp_name'])){
                $this->fitness_photo_2 = $data['fitness_photo_2'];
                $data['fitness_photo_2']['tmp_name'] = null;

            }
            if (!is_null($data['fitness_photo_3']['tmp_name']))
            {
                $this->fitness_photo_3 = $data['fitness_photo_3']['tmp_name'];
                $data['fitness_photo_3']['tmp_name'] = null;

            }
            if (isset($data['fitness_photo_3']['tmp_name'])){
                $this->fitness_photo_3 = $data['fitness_photo_3'];
                $data['fitness_photo_3']['tmp_name'] = null;

            }
            $this->fitness_time_work  = (!empty($data['fitness_time_work'])) ? $data['fitness_time_work'] : null;
            $this->fitness_ticket_price  = (!empty($data['fitness_ticket_price'])) ? $data['fitness_ticket_price'] : null;
            $this->fitness_telephone  = (!empty($data['fitness_telephone'])) ? $data['fitness_telephone'] : null;
            $this->fitness_address  = (!empty($data['fitness_address'])) ? $data['fitness_address'] : null;
            $this->fitness_description  = (!empty($data['fitness_description'])) ? $data['fitness_description'] : null;
            $this->fitness_site = (!empty($data['fitness_site'])) ? $data['fitness_site'] : null;
            $this->fitness_longitude  = (!empty($data['fitness_longitude'])) ? $data['fitness_longitude'] : null;
            $this->fitness_latitude = (!empty($data['fitness_latitude'])) ? $data['fitness_latitude'] : null;
            $this->fitness_vk  = (!empty($data['fitness_vk'])) ? $data['fitness_vk'] : null;
            $this->fitness_facebook  = (!empty($data['fitness_facebook'])) ? $data['fitness_facebook'] : null;
            $this->fitness_foursquare  = (!empty($data['fitness_foursquare'])) ? $data['fitness_foursquare'] : null;
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
                        'name'     => 'fitness_id',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'Int'),
                        ),
                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'fitness_id_name',
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
                        'name'     => 'fitness_name',
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
                    $file = new FileInput('fitness_main_photo');

                    $file->setRequired(true);
                    $file->getFilterChain()->attachByName(
                        'filerenameupload',
                        array(
                            'target'          => './yalta/img/fitness/*',
                            'overwrite'       => true,
                            'use_upload_name' => true,
                        )
                    );
                   $inputFilter->add($file);
                $file = new FileInput('fitness_photo_1');

                $file->setRequired(true);
                $file->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'          => './yalta/img/fitness/*',
                        'overwrite'       => true,
                        'use_upload_name' => true,
                    )
                );
                $inputFilter->add($file);
                $file = new FileInput('fitness_photo_2');

                $file->setRequired(true);
                $file->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'          => './yalta/img/fitness/*',
                        'overwrite'       => true,
                        'use_upload_name' => true,
                    )
                );
                $inputFilter->add($file);
                $file = new FileInput('fitness_photo_3');

                $file->setRequired(true);
                $file->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'          => './yalta/img/fitness/*',
                        'overwrite'       => true,
                        'use_upload_name' => true,
                    )
                );
                $inputFilter->add($file);


                $inputFilter->add($factory->createInput(array(
                    'name' => 'fitness_features',
                    'disable_inarray_validator' => false
                )));

                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'fitness_time_work',
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
                        'name'     => 'fitness_ticket_price',
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
                        'name'     => 'fitness_telephone',
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
                        'name'     => 'fitness_address',
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
                        'name'     => 'fitness_description',
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
                        'name'     => 'fitness_site',
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
                        'name'     => 'fitness_longitude',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),

                    )));
                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'fitness_latitude',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),

                    )));


                    $inputFilter->add($factory->createInput(array(
                        'name'     => 'fitness_vk',
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
                    'name'     => 'fitness_facebook',
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
                    'name'     => 'fitness_foursquare',
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