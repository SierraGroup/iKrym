<?php
     namespace Attractions\Options;
     interface AttractionServiceOptionsInterface{
        /*set attraction entity class name */
        public  function setAttractionEntityClass($attractionEntityClass);

       /*get attraction entity class name */
        public  function getAttractionEntityClass();
     }