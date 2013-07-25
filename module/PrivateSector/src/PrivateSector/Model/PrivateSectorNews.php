<?php
    namespace PrivateSector\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\InputFilter\InputFilter;
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\FileInput;


    class PrivateSectorNews{
            public $private_sector_news_id;
            public $private_sector_id_name;
            public $private_sector_news_image;
            public $private_sector_news_header;
            public $private_sector_news_news;
            public $private_sector_news_date;
            public $input_filter;

        public  function exchangeArray($data){
            $this->private_sector_news_id  = (!empty($data['private_sector_news_id'])) ? $data['private_sector_news_id'] : null;

            $this->private_sector_id_name  = (!empty($data['private_sector_id_name'])) ? $data['private_sector_id_name'] : null;
            if (!is_null($data['private_sector_news_image']['tmp_name']))
            {
                $this->private_sector_news_image = $data['private_sector_news_image']['tmp_name'];
                $data['private_sector_news_image']['tmp_name'] = null;

            }
            if (isset($data['private_sector_news_image']['tmp_name'])){
                $this->private_sector_news_image = $data['private_sector_news_image'];
                $data['private_sector_news_image']['tmp_name'] = null;

            }
            $this->private_sector_news_header = (!empty($data['private_sector_news_header'])) ? $data['private_sector_news_header'] : null;
            $this->private_sector_news_news  = (!empty($data['private_sector_news_news'])) ? $data['private_sector_news_news'] : null;
            $this->private_sector_news_date  = (!empty($data['private_sector_news_date'])) ? $data['private_sector_news_date'] : null;

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
                    'name'     => 'private_sector_news_id',
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
                //https://github.com/cgmartin/ZF2FileUploadExamples/blob/master/src/ZF2FileUploadExamples/Form/SingleUpload.php
                $file = new FileInput('private_sector_news_image');

                $file->setRequired(true);
                $file->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'          => './yalta/img/private_sector/news/*',
                        'overwrite'       => true,
                        'use_upload_name' => true,
                    )
                );
                $inputFilter->add($file);
                $inputFilter->add($factory->createInput(array(
                    'name'     => 'private_sector_news_header',
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
                    'name'     => 'private_sector_news_news',
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
                    'name'     => 'private_sector_news_date',
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