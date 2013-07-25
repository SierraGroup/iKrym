<?php
        namespace Attraction\Entity;

        interface AttractionInterface{
            public  function setAttractionId($attractionId);
            public  function getAttractionId();
            public  function setAttractionName($attractionName);
            public  function getAttractionName();
            public  function setAttractionAddress($attractionAddress);
            public  function getAttractionAddress();
            public  function setAttractionDescription($attractionDescription);
            public  function getAttractionDescription();
            public  function setAttractionLongitude($attractionLongitude);
            public  function getAttractionLongitude();
            public  function setAttractionLatitude($attractionLatitude);
            public  function getAttractionLatitude();
            public  function setAttractionFoursquare($attractionFoursquare);
            public  function getAttractionFoursquare();
            public  function setAttractionMainPhoto($attractionMainPhoto);
            public  function getAttractionMainPhoto();
            public  function setAttractionVK($attractionVK);
            public  function getAttractionVK();
            public  function setAttractionFacebook($attractionFacebook);
            public  function getAttractionFacebook();

        }