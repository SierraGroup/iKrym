<?php
    namespace Attractions\Options;
    use Zend\Stdlib\AbstractOptions;

    class ModuleOptions extends AbstractOptions implements AttractionServiceOptionsInterface {

        protected $attractionEntityClass = 'Attraction\Entity\Attraction';
        protected $attractionFormTimeout = 300;
        protected $tableName = 'Attractions';
        protected $enableAddAttraction = true;
        protected $enableAttractionName = true;
        protected $enableAttractionAddress = false;
        protected $enableAttractionDescription = false;

        public function setEnableAddAttraction($enableAddAttraction){
            $this->enableAddAttraction = $enableAddAttraction;
        }
        public function getEnableAddAttraction(){
            return $this->enableAddAttraction;
        }

        public function setEnableAttractionAddress($enableAttractionAddress){
            $this->enableAttractionAddress = $enableAttractionAddress;
        }
        public function getEnableAttractionAddress(){
            return $this->enableAttractionAddress;
        }
        public function setEnableAttractionName($enableAttractionName){
            $this->enableAttractionName = $enableAttractionName;
        }
        public function getEnableAttractionName(){
            return $this->enableAttractionName;
        }
        public function setEnableAttractionDescription($enableAttractionDescription){
            $this->enableAttractionDescription = $enableAttractionDescription;
        }
        public function getEnableAttractionDescription(){
            return $this->enableAttractionDescription;
        }
        public  function setTableName($tableName){
            $this->tableName = $tableName;
        }

        public  function getTableName(){
            return $this->tableName;
        }
        public  function setAttractionEntityClass($attractionEntityClass){
            $this->attractionEntityClass = $attractionEntityClass;
        }
        public  function getAttractionEntityClass(){
            return $this->attractionEntityClass;
        }

    }