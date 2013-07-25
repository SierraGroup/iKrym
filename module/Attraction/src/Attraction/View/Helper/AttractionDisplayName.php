<?php
    namespace Attractions\View\Helper;
    use Zend\Authentication\AuthenticationService;
    use Zend\View\Helper\AbstractHelper;

    class AttractionDisplayName extends  AbstractHelper{
        protected $authService;
        public  function  setAuthService(AuthenticationService $authService){

        }
    }