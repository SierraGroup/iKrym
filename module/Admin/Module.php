<?php
    namespace Admin;
    use Zend\ModuleManager\ModuleManager;

    //загружаем интерфейс для поддержки автозагрузки некоторых классов
    use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

    //загружаем интерфейс для поддержки конфигурации модуля
    use Zend\ModuleManager\Feature\ConfigProviderInterface;

    //загружаем интерфейс для поддержки сервисов модуля
    use Zend\ModuleManager\Feature\ServiceProviderInterface;

    //cоздаем клас для идентификации Модуля для управлением пользоватеёлем
    class Module implements AutoloaderProviderInterface,
                            ConfigProviderInterface,
                            ServiceProviderInterface{

        //Autoloader provider interface
        public function getAutoloaderConfig(){

            return array(
                    'Zend\Loader\ClassMapAutoloader' => array(
                        __DIR__.'/autoload_classmap.php'
                    ),
                    'Zend\Loader\StandardAutoloader' => array(
                        __NAMESPACE__ => __DIR__ .'/src/'.__NAMESPACE__,
                    ),
            );
        }
        public  function getConfig(){
            return include __DIR__ .'/config/module.config.php';
        }
        public  function getServiceConfig(){
            return array(
                'factories' => array(
                        'admin_service' => 'Admin\Service\Admin',
                ),
            );
        }

    }