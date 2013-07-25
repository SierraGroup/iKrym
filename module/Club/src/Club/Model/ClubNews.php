<?php
namespace Club\Model;
use Zend\Db\TableGateway\TableGateway;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\FileInput;


class ClubNews{
    public $club_news_id;
    public $club_id_name;
    public $club_news_image;
    public $club_news_header;
    public $club_news_news;
    public $club_news_date;
    public $input_filter;

    public  function exchangeArray($data){
        $this->club_news_id  = (!empty($data['club_news_id'])) ? $data['club_news_id'] : null;

        $this->club_id_name  = (!empty($data['club_id_name'])) ? $data['club_id_name'] : null;
        if (!is_null($data['club_news_image']['tmp_name']))
        {
            $this->club_news_image = $data['club_news_image']['tmp_name'];
            $data['club_news_image']['tmp_name'] = null;

        }
        if (isset($data['club_news_image']['tmp_name'])){
            $this->club_news_image = $data['club_news_image'];
            $data['club_news_image']['tmp_name'] = null;

        }
        $this->club_news_header = (!empty($data['club_news_header'])) ? $data['club_news_header'] : null;
        $this->club_news_news  = (!empty($data['club_news_news'])) ? $data['club_news_news'] : null;
        $this->club_news_date  = (!empty($data['club_news_date'])) ? $data['club_news_date'] : null;

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
                'name'     => 'club_news_id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'club_id_name',
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
            $file = new FileInput('club_news_image');

            $file->setRequired(true);
            $file->getFilterChain()->attachByName(
                'filerenameupload',
                array(
                    'target'          => './yalta/img/club/news/*',
                    'overwrite'       => true,
                    'use_upload_name' => true,
                )
            );
            $inputFilter->add($file);
            $inputFilter->add($factory->createInput(array(
                'name'     => 'club_news_header',
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
                'name'     => 'club_news_news',
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
                'name'     => 'club_news_date',
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