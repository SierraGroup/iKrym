<?php
    namespace Entertainment;

    use Entertainment\Model\EntertainmentPoster;
    use Entertainment\Model\EntertainmentPosterTable;

    use Entertainment\Model\EntertainmentNews;
    use Entertainment\Model\EntertainmentNewsTable;

    use Entertainment\Model\Entertainment;
    use Entertainment\Model\EntertainmentTable;

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
                            'Entertainment\Model\EntertainmentTable' =>  function($sm) {
                                $tableGateway = $sm->get('EntertainmentTableGateway');
                                $table = new EntertainmentTable($tableGateway);
                                return $table;
                            },
                            'Entertainment\Model\EntertainmentNewsTable' => function($sm){
                                $tableGateway = $sm->get('EntertainmentNewsTableGateway');
                                $table = new EntertainmentNewsTable($tableGateway);
                                return $table;
                            },
                            'Entertainment\Model\EntertainmentPosterTable' => function($sm){
                                $tableGateway = $sm->get('EntertainmentPosterTableGateway');
                                $table = new EntertainmentPosterTable($tableGateway);
                                return $table;
                            },
                            'EntertainmentTableGateway' => function ($sm) {
                                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                $resultSetPrototype = new ResultSet();
                                $resultSetPrototype->setArrayObjectPrototype(new Entertainment());

                                return new TableGateway('entertainment', $dbAdapter, null, $resultSetPrototype);
                            },
                            'EntertainmentNewsTableGateway' => function($sm){
                                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                $resultSetPrototype = new ResultSet();
                                $resultSetPrototype->setArrayObjectPrototype(new EntertainmentNews());
                                return new TableGateway('entertainment_news',$dbAdapter,null,$resultSetPrototype);
                            },
                            'EntertainmentPosterTableGateway' => function($sm){
                                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                                $resultSetPrototype = new ResultSet();
                                $resultSetPrototype->setArrayObjectPrototype(new EntertainmentPoster());
                                return new TableGateway('entertainment_poster',$dbAdapter,null,$resultSetPrototype);
                            },



                ),
              );
            }

    }