<?php
    namespace GoogleMaps;
    use GoogleMaps\Service;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\TableGateway\TableGateway;

    class Module{

                 //the ModuleManager will call getAutoloaderConfig and getConfig() automatically for us
                public  function  getAutoloaderConfig(){
                        return array(

                            'Zend\Loader\ClassMapAutoloader' => array(
                                __DIR__ .'/autoload_classmap.php',
                            ),
                            'Zend\Loader\StandardAutoloader' => array(
                                'namespaces' => array(
                                    __NAMESPACE__ => __DIR__ .'/src/'.__NAMESPACE__,
                                ),
                            ),
                        );
                }
                public  function  getConfig(){
                    return include __DIR__.'/config/module.config.php';
                }
                public function getServiceConfig(){
                        return array(
                            'factories' => array(
                                'GoogleMaps\Service\GoogleMap' => function($sm){
                                        $config = $sm->get('config');
                                        return new \GoogleMaps\Service\GoogleMap($config['GoogleMaps']['api_key']);


                                },

                            ),
                        );
                }
    }