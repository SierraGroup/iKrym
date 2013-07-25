<?php
    namespace Attraction\Mapper;
    use Zend\Stdlib\Hydrator\ClassMethods;
    use Attraction\Entity\AttractionInterface as AttractionInterface;
    use Zend\Stdlib\Hydrator;

    class AttractionHydrator extends ClassMethods{
            public  function extract($object){
                    if(!$object instanceof AttractionInterface){
                        throw new Exception\InvalidArgumentException("object must be an instance of AttribationHydrator ");
                    }

                    /*  @var $object AttractionInterface */
                    $data = parent::extract($object);
                    $data = $this->mapField('id','attraction_id',$data);
                    return $data;
            }
            public  function hydrate(array $data,$object){
                    $data  = $this->mapField('attraction_id','id',$data);
                    return parent::hydrate($data,$object);

            }
            protected  function mapField($keyFrom,$keyTo , array $array){
                    $array[$keyTo] = $array[$keyFrom];
                    unset($array[$keyFrom]);
                    return $array;
            }
    }