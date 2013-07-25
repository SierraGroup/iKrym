<?php
    namespace PrivateSector\Model;
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    use Zend\InputFilter\InputFilterAwareInterface;
    use Zend\InputFilter\InputFilterInterface;
    use Zend\InputFilter\FileInput;

    class PrivateSectorPoster{
        public $private_sector_poster_id;
        public $private_sector_id_name;
        public $private_sector_poster_name;
        public $private_sector_poster_image;
        public $private_sector_poster_header;
        public $private_sector_poster_date;
        public $private_sector_poster_description;

        protected $input_filter;

        public  function exchangeArray($data){
            $this->private_sector_poster_id  = (!empty($data['private_sector_poster_id'])) ? $data['private_sector_poster_id'] : null;
            $this->private_sector_id_name  = (!empty($data['private_sector_id_name'])) ? $data['private_sector_id_name'] : null;
            $this->private_sector_poster_name  = (!empty($data['private_sector_poster_name'])) ? $data['private_sector_poster_name'] : null;
            $this->private_sector_poster_image = (!empty($data['private_sector_poster_image'])) ? $data['private_sector_poster_image'] : null;
            $this->private_sector_poster_header = (!empty($data['private_sector_poster_header'])) ? $data['private_sector_poster_header'] : null;
            $this->private_sector_poster_date  = (!empty($data['private_sector_poster_date'])) ? $data['private_sector_poster_date'] : null;
            $this->private_sector_poster_description  = (!empty($data['private_sector_poster_description'])) ? $data['private_sector_poster_description'] : null;

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
                    'name'     => 'private_sector_poster_id',
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
                                'max'      => 1000,
                            ),
                        ),
                    ),
                )));
                $inputFilter->add($factory->createInput(array(
                    'name'     => 'private_sector_poster_name',
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
                //https://github.com/cgmartin/ZF2FileUploadExamples/blob/master/src/ZF2FileUploadExamples/Form/SingleUpload.php
                $file = new FileInput('private_sector_poster_image');

                $file->setRequired(true);
                $file->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'          => './yalta/img/private_sector/posters/*',
                        'overwrite'       => true,
                        'use_upload_name' => true,
                    )
                );
                $inputFilter->add($file);
                $inputFilter->add($factory->createInput(array(
                    'name'     => 'private_sector_poster_header',
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
                    'name'     => 'private_sector_poster_date',
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
                    'name'     => 'private_sector_poster_description',
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
