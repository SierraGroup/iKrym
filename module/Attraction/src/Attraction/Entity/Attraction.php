<?php
    namespace Attraction\Entity;
    class Attraction implements AttractionInterface{
        protected $attraction_id;
        protected $attraction_name;
        protected $attraction_address;
        protected $attraction_description;
        protected $attraction_longitude;
        protected $attraction_latitude;
        protected $attraction_foursquare;
        protected $attraction_main_photo;
        protected $attraction_vk;
        protected $attraction_facebook;

        /**
         * @param mixed $attraction_name
         */
        public function setAttractionName($attraction_name)
        {
            $this->attraction_name = $attraction_name;
        }

        /**
         * @return mixed
         */
        public function getAttractionName()
        {
            return $this->attraction_name;
        }

        /**
         * @param mixed $attraction_vk
         */
        public function setAttractionVK($attraction_vk)
        {
            $this->attraction_vk = $attraction_vk;
        }

        /**
         * @return mixed
         */
        public function getAttractionVK()
        {
            return $this->attraction_vk;
        }

        /**
         * @param mixed $attraction_main_photo
         */
        public function setAttractionMainPhoto($attraction_main_photo)
        {
            $this->attraction_main_photo = $attraction_main_photo;
        }

        /**
         * @return mixed
         */
        public function getAttractionMainPhoto()
        {
            return $this->attraction_main_photo;
        }

        /**
         * @param mixed $attraction_latitude
         */
        public function setAttractionLatitude($attraction_latitude)
        {
            $this->attraction_latitude = $attraction_latitude;
        }

        /**
         * @return mixed
         */
        public function getAttractionLatitude()
        {
            return $this->attraction_latitude;
        }

        /**
         * @param mixed $attraction_longitude
         */
        public function setAttractionLongitude($attraction_longitude)
        {
            $this->attraction_longitude = $attraction_longitude;
        }

        /**
         * @return mixed
         */
        public function getAttractionLongitude()
        {
            return $this->attraction_longitude;
        }

        /**
         * @param mixed $attraction_id
         */
        public function setAttractionId($attraction_id)
        {
            $this->attraction_id = $attraction_id;
        }

        /**
         * @return mixed
         */
        public function getAttractionId()
        {
            return $this->attraction_id;
        }

        /**
         * @param mixed $attraction_foursquare
         */
        public function setAttractionFoursquare($attraction_foursquare)
        {
            $this->attraction_foursquare = $attraction_foursquare;
        }

        /**
         * @return mixed
         */
        public function getAttractionFoursquare()
        {
            return $this->attraction_foursquare;
        }

        /**
         * @param mixed $attraction_description
         */
        public function setAttractionDescription($attraction_description)
        {
            $this->attraction_description = $attraction_description;
        }

        /**
         * @return mixed
         */
        public function getAttractionDescription()
        {
            return $this->attraction_description;
        }

        /**
         * @param mixed $attraction_facebook
         */
        public function setAttractionFacebook($attraction_facebook)
        {
            $this->attraction_facebook = $attraction_facebook;
        }

        /**
         * @return mixed
         */
        public function getAttractionFacebook()
        {
            return $this->attraction_facebook;
        }

        /**
         * @param mixed $attraction_address
         */
        public function setAttractionAddress($attraction_address)
        {
            $this->attraction_address = $attraction_address;
        }

        /**
         * @return mixed
         */
        public function getAttractionAddress()
        {
            return $this->attraction_address;
        }
    }