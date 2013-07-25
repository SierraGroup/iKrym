<?php
    namespace Fitness;


    use Fitness\Model\Fitness;
    use Fitness\Model\FitnessTable;

    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\Adapter\Adapter;
    use Zend\Db\Adapter\Driver\Pdo;

    class Module
    {
            public  function getAutoloaderConfig(){
                return array(
                    'Zend\Loader\ClassMapAutoloader' => array(
                         __DIR__.'/autoload_classmap.php',
                    ),
                    'Zend\Loader\StandardAutoloader' => array(
                        'namespaces' => array(
                            __NAMESPACE__ => __DIR__ .'/src/'.__NAMESPACE__,
                        ),
                    ),
                );
            }
            public  function getConfig(){
                return include __DIR__ .'/config/module.config.php';
            }
            public  function getServiceConfig(){
                return array(
                    'factories' => array(
                            'Fitness\Model\FitnessTable' =>  function($sm) {
                                $tableGateway = $sm->get('FitnessTableGateway');
                                $table = new FitnessTable($tableGateway);
                                return $table;
                            },
                            'FitnessTableGateway' => function ($sm) {
                                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                $resultSetPrototype = new ResultSet();
                                $resultSetPrototype->setArrayObjectPrototype(new Fitness());

                                return new TableGateway('fitness', $dbAdapter, null, $resultSetPrototype);
                            },




                ),
              );
            }

    }