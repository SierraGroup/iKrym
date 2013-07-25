<?php
    namespace PrivateSector;

    use PrivateSector\Model\PrivateSectorPoster;
    use PrivateSector\Model\PrivateSectorPosterTable;

    use PrivateSector\Model\PrivateSectorNews;
    use PrivateSector\Model\PrivateSectorNewsTable;

    use PrivateSector\Model\PrivateSector;
    use PrivateSector\Model\PrivateSectorTable;

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
                            'PrivateSector\Model\PrivateSectorTable' =>  function($sm) {
                                $tableGateway = $sm->get('PrivateSectorTableGateway');
                                $table = new PrivateSectorTable($tableGateway);
                                return $table;
                            },
                            'PrivateSector\Model\PrivateSectorNewsTable' => function($sm){
                                $tableGateway = $sm->get('PrivateSectorNewsTableGateway');
                                $table = new PrivateSectorNewsTable($tableGateway);
                                return $table;
                            },
                            'PrivateSector\Model\PrivateSectorPosterTable' => function($sm){
                                $tableGateway = $sm->get('PrivateSectorPosterTableGateway');
                                $table = new PrivateSectorPosterTable($tableGateway);
                                return $table;
                            },
                            'PrivateSectorTableGateway' => function ($sm) {
                                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                $resultSetPrototype = new ResultSet();
                                $resultSetPrototype->setArrayObjectPrototype(new PrivateSector());

                                return new TableGateway('private_sector', $dbAdapter, null, $resultSetPrototype);
                            },
                            'PrivateSectorNewsTableGateway' => function($sm){
                                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                $resultSetPrototype = new ResultSet();
                                $resultSetPrototype->setArrayObjectPrototype(new PrivateSectorNews());
                                return new TableGateway('private_sector_news',$dbAdapter,null,$resultSetPrototype);
                            },
                            'PrivateSectorPosterTableGateway' => function($sm){
                                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                $resultSetPrototype = new ResultSet();
                                $resultSetPrototype->setArrayObjectPrototype(new PrivateSectorPoster());
                                return new TableGateway('private_sector_poster',$dbAdapter,null,$resultSetPrototype);
                            },



                ),
              );
            }

    }