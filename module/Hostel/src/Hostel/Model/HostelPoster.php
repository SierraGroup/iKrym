<?php
namespace Hostel\Model;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\FileInput;

class HostelPoster{
    public $hostel_poster_id;
    public $hostel_id_name;
    public $hostel_poster_name;
    public $hostel_poster_image;
    public $hostel_poster_header;
    public $hostel_poster_date;
    public $hostel_poster_description;

    protected $input_filter;

    public  function exchangeArray($data){
        $this->hostel_poster_id  = (!empty($data['hostel_poster_id'])) ? $data['hostel_poster_id'] : null;
        $this->hostel_id_name  = (!empty($data['hostel_id_name'])) ? $data['hostel_id_name'] : null;
        $this->hostel_poster_name  = (!empty($data['hostel_poster_name'])) ? $data['hostel_poster_name'] : null;
        $this->hostel_poster_image = (!empty($data['hostel_poster_image'])) ? $data['hostel_poster_image'] : null;
        $this->hostel_poster_header = (!empty($data['hostel_poster_header'])) ? $data['hostel_poster_header'] : null;
        $this->hostel_poster_date  = (!empty($data['hostel_poster_date'])) ? $data['hostel_poster_date'] : null;
        $this->hostel_poster_description  = (!empty($data['hostel_poster_description'])) ? $data['hostel_poster_description'] : null;

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
                'name'     => 'hostel_poster_id',
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
            $inputFilter->add($factory->createInput(array(
                'name'     => 'hostel_poster_name',
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
            $file = new FileInput('hostel_poster_image');

            $file->setRequired(true);
            $file->getFilterChain()->attachByName(
                'filerenameupload',
                array(
                    'target'          => './yalta/img/attraction/posters/*',
                    'overwrite'       => true,
                    'use_upload_name' => true,
                )
            );
            $inputFilter->add($file);
            $inputFilter->add($factory->createInput(array(
                'name'     => 'hostel_poster_header',
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
                'name'     => 'hostel_poster_date',
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
                'name'     => 'hostel_poster_description',
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
