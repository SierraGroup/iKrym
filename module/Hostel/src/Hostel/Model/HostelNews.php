<?php
namespace Hostel\Model;
use Zend\Db\TableGateway\TableGateway;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\FileInput;


class HostelNews{
    public $hostel_news_id;
    public $hostel_id_name;
    public $hostel_news_image;
    public $hostel_news_header;
    public $hostel_news_news;
    public $hostel_news_date;
    public $input_filter;

    public  function exchangeArray($data){
        $this->hostel_news_id  = (!empty($data['hostel_news_id'])) ? $data['hostel_news_id'] : null;

        $this->hostel_id_name  = (!empty($data['hostel_id_name'])) ? $data['hostel_id_name'] : null;
        if (!is_null($data['hostel_news_image']['tmp_name']))
        {
            $this->hostel_news_image = $data['hostel_news_image']['tmp_name'];
            $data['hostel_news_image']['tmp_name'] = null;

        }
        if (isset($data['hostel_news_image']['tmp_name'])){
            $this->hostel_news_image = $data['hostel_news_image'];
            $data['hostel_news_image']['tmp_name'] = null;

        }
        $this->hostel_news_header = (!empty($data['hostel_news_header'])) ? $data['hostel_news_header'] : null;
        $this->hostel_news_news  = (!empty($data['hostel_news_news'])) ? $data['hostel_news_news'] : null;
        $this->hostel_news_date  = (!empty($data['hostel_news_date'])) ? $data['hostel_news_date'] : null;

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
                'name'     => 'hostel_news_id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'hostel_id_name',
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
            $file = new FileInput('hostel_news_image');

            $file->setRequired(true);
            $file->getFilterChain()->attachByName(
                'filerenameupload',
                array(
                    'target'          => './yalta/img/hostel/news/*',
                    'overwrite'       => true,
                    'use_upload_name' => true,
                )
            );
            $inputFilter->add($file);
            $inputFilter->add($factory->createInput(array(
                'name'     => 'hostel_news_header',
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
                'name'     => 'hostel_news_news',
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
                'name'     => 'hostel_news_date',
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
            $this->input_filter = $inputFilter;
        }
        return $this->input_filter;
    }
}