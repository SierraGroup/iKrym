<?php
    namespace Attraction;

    use Attraction\Model\AttractionPoster;
    use Attraction\Model\AttractionPosterTable;

    use Attraction\Model\AttractionNews;
    use Attraction\Model\AttractionNewsTable;

    use Attraction\Model\Attraction;
    use Attraction\Model\AttractionTable;

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
                            'Attraction\Model\AttractionTable' =>  function($sm) {
                                $tableGateway = $sm->get('AttractionTableGateway');
                                $table = new AttractionTable($tableGateway);
                                return $table;
                            },
                            'Attraction\Model\AttractionNewsTable' => function($sm){
                                $tableGateway = $sm->get('AttractionNewsTableGateway');
                                $table = new AttractionNewsTable($tableGateway);
                                return $table;
                            },
                            'Attraction\Model\AttractionPosterTable' => function($sm){
                                $tableGateway = $sm->get('AttractionPosterTableGateway');
                                $table = new AttractionPosterTable($tableGateway);
                                return $table;
                            },
                            'AttractionTableGateway' => function ($sm) {
                                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                $resultSetPrototype = new ResultSet();
                                $resultSetPrototype->setArrayObjectPrototype(new Attraction());

                                return new TableGateway('attraction', $dbAdapter, null, $resultSetPrototype);
                            },
                            'AttractionNewsTableGateway' => function($sm){
                                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                $resultSetPrototype = new ResultSet();
                                $resultSetPrototype->setArrayObjectPrototype(new AttractionNews());
                                return new TableGateway('attraction_news',$dbAdapter,null,$resultSetPrototype);
                            },
                            'AttractionPosterTableGateway' => function($sm){
                                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                $resultSetPrototype = new ResultSet();
                                $resultSetPrototype->setArrayObjectPrototype(new AttractionPoster());
                                return new TableGateway('attraction_poster',$dbAdapter,null,$resultSetPrototype);
                            },



                ),
              );
            }

    }