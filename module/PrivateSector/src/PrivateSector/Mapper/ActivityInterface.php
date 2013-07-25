<?php
    namespace Attraction\Mapper;
    interface AttractionInterface{
        public  function insert($attraction);
        public  function update($attraction);
        public  function findByName($name);
        public  function  findByAddress($address);
        public  function findByDescription($description);

    }