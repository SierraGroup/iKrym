<?php
/**
 * Copyright (c) 2012 Jurian Sluiman.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the names of the copyright holders nor the names of the
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package     ZfcAdmin
 * @subpackage  Controller
 * @author      Jurian Sluiman <jurian@soflomo.com>
 * @copyright   2012 Jurian Sluiman.
 * @license     http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link        http://zf-commons.github.com
 */

namespace ZfcAdmin\Controller;

use Timetable\Model\TransportRoadMinibus;
use Timetable\Form\MinibusForm;

use Timetable\Model\SheduleRoadMinibus;
use Timetable\Form\SheduleMinibusForm;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

use Restaurant\Controller;
use Restaurant\Form\RestaurantForm;
use Restaurant\Model\Restaurant;

use Restaurant\Form\RestaurantMenuForm;
use Restaurant\Model\RestaurantMenu;

use Restaurant\Form\RestaurantNewsForm;
use Restaurant\Model\RestaurantNews;


use Hostel\Form\HostelForm;
use Hostel\Model\Hostel;

use Cafe\Model\Cafe;
use Cafe\Form\CafeForm;

use Club\Model\Club;
use Club\Form\ClubForm;

use Club\Model\ClubNews;
use Club\Form\ClubNewsForm;

use Attraction\Form\AttractionForm;
use Attraction\Model\Attraction;

use Attraction\Form\AttractionNewsForm;
use Attraction\Model\AttractionNews;

use Attraction\Form\AttractionPosterForm;
use Attraction\Model\AttractionPoster;

use Entertainment\Form\EntertainmentForm;
use Entertainment\Model\Entertainment;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\View;


class AdminController extends AbstractActionController
{
        protected $sessionContainer;

        //restaurants table
        protected $restaurantsTable;
        protected $restaurantsMenuTable;
        protected $restaurantsNewsTable;

        //hostels table
        protected $hostelsTable;

        //cafes table
        protected $cafesTable;

        //club table
        protected $clubsTable;
        protected $clubsNewsTable;



        //entertainments table
        protected $entertainmentsTable;

        //transports table
        protected $transportRoadMinibusTable;
        //transports shedule table
        protected $sheduleRoadMinibusTable;


        const ROUTE_LOGIN   = 'zfcuser/login';


    public function __construct()
    {
        $this->sessionContainer = new Container('file_upload_examples');
    }

        public  function indexAction(){


                    $admin_view = new ViewModel();
                    $admin_view->setTerminal(true);
                    $content_admin_view = new ViewModel();
                    $sidebar_admin_view = new ViewModel();
                    $admin_menu = new ViewModel();
                    $upload  = new ViewModel();
                    $content_admin_view->setTemplate('zfc-admin/block/content_admin');
                    $sidebar_admin_view->setTemplate('zfc-admin/block/sidebar_admin');
                    $admin_menu->setTemplate('zfc-admin/block/admin_menu');
                    $upload->setTemplate('zfc-admin/block/upload');
                    $content_admin_view->addChild($upload,'upload');
                    $admin_view->addChild($content_admin_view,'content_admin')->addChild($admin_menu,'admin')->addChild($sidebar_admin_view,'sidebar')->addChild($upload,'upload');
                     return $admin_view;

            }








        /*------------------------------HOSTEL CONTROLLER-------------------------------------------*/

            public  function hostelsAction(){
                $view = new ViewModel();

                $hostels= $this->getHostelsTable()->fetchAll();
                $view->setVariable('hostels',$hostels);

                $admin_menu = new ViewModel();
                $admin_menu->setTemplate('zfc-admin/block/admin_menu');
                $view->addChild($admin_menu,'admin');
                return $view;
            }
            public function getHostelsTable()
            {
                if (!$this->hostelsTable) {
                    $sm = $this->getServiceLocator();
                    $this->hostelsTable = $sm->get('Hostel\Model\HostelTable');
                }
                return $this->hostelsTable;
            }
            public  function hostelsAddAction(){
                $form = new HostelForm();

                $form->get('submit')->setValue('Добавить гостиницу');


                $request = $this->getRequest();

                if ($request->isPost()) {
                    $hostel = new Hostel();
                           $form->setInputFilter($hostel->getInputFilter());

                    // Make certain to merge the files info!
                    $data= array_merge_recursive(
                        $this->getRequest()->getPost()->toArray(),
                        $this->getRequest()->getFiles()->toArray()
                    );
                    $form->setData($data);
                    if ($form->isValid()){
                            $hostel->exchangeArray($form->getData());
                        // $restaurant->e
                                $this->getHostelsTable()->saveHostel($hostel);

                        // Form is valid, save the form!
                        return $this->redirectToSuccessPage($form->getData());

                        // Redirect to list of albums
                        // return $this->redirect()->toRoute('zfcadmin/restaurants');
                    }


                }
                //else return $this->redirect()->toRoute('zfcadmin');
                return array('form' => $form);
            }

        /*------------------------------CAFES CONTROLLER-------------------------------------------*/

                public function cafesAction(){
                    $view = new ViewModel();

                    $cafes = $this->getCafesTable()->fetchAll();
                    $view->setVariable('cafes',$cafes);

                    $admin_menu = new ViewModel();
                    $admin_menu->setTemplate('zfc-admin/block/admin_menu');
                    $view->addChild($admin_menu,'admin');
                    return $view;
                }

                public function getCafesTable()
                {
                    if (!$this->cafesTable) {
                        $sm = $this->getServiceLocator();
                        $this->cafesTable = $sm->get('Cafe\Model\CafeTable');
                    }
                    return $this->cafesTable;
                }
                public  function cafesAddAction(){
                    $form = new CafeForm();

                    $form->get('submit')->setValue('Добавить кафе');


                    $request = $this->getRequest();
                    if ($request->isPost()) {
                        $cafe= new Cafe();
                        $form->setInputFilter($cafe->getInputFilter());

                        // Make certain to merge the files info!
                        $data= array_merge_recursive(
                            $this->getRequest()->getPost()->toArray(),
                            $this->getRequest()->getFiles()->toArray()
                        );
                        $form->setData($data);
                        if ($form->isValid()){
                            $cafe->exchangeArray($form->getData());
                            // $restaurant->e
                            $this->getCafesTable()->saveCafe($cafe);
                            // Form is valid, save the form!
                            return $this->redirectToSuccessPage($form->getData());
                        }
                    }
                    return array('form' => $form);
                }

        /*---------------------------------CLUB CONTROLLER-------------------------------------------*/
            public function clubAction(){
                $view = new ViewModel();

                $admin_menu = new ViewModel();
                $admin_menu->setTemplate('zfc-admin/block/admin_menu');
                $view->addChild($admin_menu,'admin');

                $sidebar= new ViewModel();
                $sidebar->setTemplate('zfc-admin/block/sidebar_admin');
                $view->addChild($sidebar,'sidebar');

                $clubs = $this->getClubsTable()->fetchAll();
                $view->setVariable('clubs',$clubs);


                return $view;
            }

            public function getClubsTable()
            {
                if (!$this->clubsTable) {
                    $sm = $this->getServiceLocator();
                    $this->clubsTable = $sm->get('Club\Model\ClubTable');
                }
                return $this->clubsTable;
            }
            public function getClubNewsTable()

            {
                if (!$this->clubsNewsTable) {
                    $sm = $this->getServiceLocator();
                    $this->clubsNewsTable = $sm->get('Club\Model\ClubNewsTable');
                }
                return $this->clubsNewsTable;
            }
            public  function  clubAddAction(){
                $form = new ClubForm();


                $admin_menu = new ViewModel();
                $admin_menu->setTemplate('zfc-admin/block/admin_menu');

                $sidebar= new ViewModel();
                $sidebar->setTemplate('zfc-admin/block/sidebar_admin');
                //$view->addChild($sidebar,'sidebar');


                $form->get('submit')->setValue('Добавить клуб');


                $request = $this->getRequest();
                if ($request->isPost()) {
                    $club = new Club();
                    $form->setInputFilter($club->getInputFilter());

                    // Make certain to merge the files info!
                    $data= array_merge_recursive(
                        $this->getRequest()->getPost()->toArray(),
                        $this->getRequest()->getFiles()->toArray()
                    );
                    $form->setData($data);
                    if ($form->isValid()){
                        $club->exchangeArray($form->getData());
                        // $restaurant->e
                        $this->getClubsTable()->saveClub($club);
                        // Form is valid, save the form!
                        return $this->redirect()->toRoute('zfcadmin/clubs');
                    }
                }

                return array('form' => $form);
            }
            public  function  clubEditAction(){
                $club_id_name = (string) $this->params()->fromRoute('club_id_name', 0);
                if (!$club_id_name) {
                    return $this->redirect()->toRoute('zfcadmin/clubs');
                }
                $club = $this->getClubsTable()->getClubByIdName($club_id_name);

                $form  = new ClubForm();
                $form->bind($club);
                $form->get('submit')->setAttribute('value', 'Редактировать клуб');
                $request = $this->getRequest();
                if ($request->isPost()) {
                    $form->setInputFilter($club->getInputFilter());
                    $form->setData($request->getPost());

                    if ($form->isValid()) {
                        $this->getClubsTable()->saveClub($club);

                        // Redirect to list of albums
                        return $this->redirect()->toRoute('zfcadmin/clubs');
                    }
                }

                return array(
                    'restaurant_id_name' => $club_id_name,
                    'form' => $form,
                );
            }
            public  function clubDeleteAction(){
                $club_id = (int) $this->params()->fromRoute('club_id',0);
                if (!$club_id) {
                    return $this->redirect()->toRoute('zfcadmin/clubs');
                }

                $request = $this->getRequest();
                if ($request->isPost()) {
                    if ($club_id) {

                        $this->getClubsTable()->deleteClub($club_id);
                        // Redirect to list of albums
                        return $this->redirect()->toRoute('zfcadmin/attractions');
                    }
                }
                return array(
                    'club_id'    => $club_id,
                    'club' => $this->getClubsTable()->getClub($club_id)
                );
            }
            public  function clubNewsAction(){}
            public  function clubNewsAddAction(){
                $form = new ClubNewsForm();

                $form->get('submit')->setValue('Добавить новость');
                $club_id_name = (string) $this->params()->fromRoute('club_id_name', 0);
                $form->get('club_id_name')->setValue($club_id_name);


                $request = $this->getRequest();

                if ($request->isPost()) {
                    $club_news = new ClubNews();
                    $form->setInputFilter($club_news->getInputFilter());

                    // Make certain to merge the files info!
                    $data= array_merge_recursive(
                        $this->getRequest()->getPost()->toArray(),
                        $this->getRequest()->getFiles()->toArray()
                    );
                    $form->setData($data);
                    if ($form->isValid()){

                        $club_news->exchangeArray($form->getData());
                        $this->getClubNewsTable()->saveClubNews($club_news);

                        // Form is valid, save the form!
                        return $this->redirect()->toUrl('zfcadmin/attractions');
                    }
                }
                //else return $this->redirect()->toRoute('zfcadmin');
                return array('form' => $form);
            }



            /*---------------------------------entertainment CONTROLLER-------------------------------------------*/
            public function entertainmentsAction(){
                $view = new ViewModel();

                $entertainments= $this->getEntertainmentsTable()->fetchAll();
                $view->setVariable('entertainments',$entertainments);

                $admin_menu = new ViewModel();
                $admin_menu->setTemplate('zfc-admin/block/admin_menu');
                $view->addChild($admin_menu,'admin');
                return $view;
            }

            public function getEntertainmentsTable()
            {
                if (!$this->entertainmentsTable) {
                    $sm = $this->getServiceLocator();
                    $this->entertainmentsTable = $sm->get('Entertainment\Model\EntertainmentTable');
                }
                return $this->entertainmentsTable;
            }
            public  function  entertainmentsAddAction(){
                $form = new EntertainmentForm();

                $form->get('submit')->setValue('Добавить развлечение');


                $request = $this->getRequest();
                if ($request->isPost()) {
                    $entertainment = new Entertainment();
                    $form->setInputFilter($entertainment->getInputFilter());

                    // Make certain to merge the files info!
                    $data= array_merge_recursive(
                        $this->getRequest()->getPost()->toArray(),
                        $this->getRequest()->getFiles()->toArray()
                    );
                    $form->setData($data);
                    if ($form->isValid()){
                        $entertainment->exchangeArray($form->getData());
                        // $restaurant->e
                        $this->getEntertainmentsTable()->saveEntertainment($entertainment);
                        // Form is valid, save the form!
                        return $this->redirectToSuccessPage($form->getData());
                    }
                }
                return array('form' => $form);
            }


        /*---------------------------------TRANSPORT CONTROLLER-------------------------------------*/

        public  function transportAction(){
            $transport = new ViewModel();

            $transport_road_minibus = $this->getTransportRoadMinibusTable()->fetchAll();
            $shedule_road_minibus = $this->getSheduleRoadMinibusTable()->fetchAll();
            $transport->setVariable('transport_road_minibus', $transport_road_minibus);
            $transport->setVariable('shedule_road_minibus', $shedule_road_minibus);

            $admin_menu = new ViewModel();
            $admin_menu->setTemplate('zfc-admin/block/admin_menu');
            $transport->addChild($admin_menu,'admin');

            $sidebar= new ViewModel();
            $sidebar->setTemplate('zfc-admin/block/sidebar_admin');
            $transport->addChild($sidebar,'sidebar');
            return $transport;
        }
        public  function minibusAddAction(){
            //$form = new RestaurantsForm();
            $transport_form = new MinibusForm();
            $transport_form->get('submit')->setValue('Добавить маршрутку');

            $request = $this->getRequest();
            if ($request->isPost()) {

                $transport_road_minibus = new TransportRoadMinibus();
               // $transport_road_minibus->setInputFilter($restaurants->getInputFilter());
                $transport_form->setData($request->getPost());


                if ($transport_form->isValid()) {
                    $transport_road_minibus->exchangeArray($transport_form->getData());
                    $this->getTransportRoadMinibusTable()->saveTransportRoadMinibus($transport_road_minibus);

                    // Redirect to list of albums
                    return $this->redirect()->toRoute('zfcadmin/transport');
                }
            }
            return array('form' => $transport_form);
        }
        public  function minibusSheduleAction(){

        }
        public  function minibusSheduleAddAction(){
            $shedule_minibus_form = new SheduleMinibusForm();
            //$transport_form = new MinibusForm();


            $shedule_minibus_form->get('submit')->setValue('Добавить расписание');

            $request = $this->getRequest();
            if ($request->isPost()) {

                $shedule_road_minibus = new SheduleRoadMinibus();
                // $transport_road_minibus->setInputFilter($restaurants->getInputFilter());
                $shedule_minibus_form->setData($request->getPost());


                if ($shedule_minibus_form->isValid()) {
                    $shedule_road_minibus->exchangeArray($shedule_minibus_form ->getData());
                    $this->getSheduleRoadMinibusTable()->saveSheduleRoadMinibus($shedule_road_minibus);

                    // Redirect to list of albums
                    return $this->redirect()->toRoute('zfcadmin/transport');
                }
            }
            return array('form' => $shedule_minibus_form );
        }
        public  function minibusSheduleEditAction(){

        }

        public function getTransportRoadMinibusTable()
        {
            if (!$this->transportRoadMinibusTable) {
                $sm = $this->getServiceLocator();
                $this->transportRoadMinibusTable= $sm->get('Timetable\Model\TransportRoadMinibusTable');
            }
            return $this->transportRoadMinibusTable;
        }
        public function getSheduleRoadMinibusTable(){
            if (!$this->sheduleRoadMinibusTable) {
                $sm = $this->getServiceLocator();
                $this->sheduleRoadMinibusTable= $sm->get('Timetable\Model\SheduleRoadMinibusTable');
            }
            return $this->sheduleRoadMinibusTable;
        }
        /*------------------------------------------------------------------------------------------*/
//
//            public function successAction()
//            {
//                return array(
//                    'formData' => $this->sessionContainer->formData,
//                );
//            }

            protected function redirectToSuccessPage($formData = null)
            {
                $this->sessionContainer->formData = $formData;
                $response = $this->redirect()->toRoute('zfcadmin/success');
                $response->setStatusCode(303);
                return $response;
            }

}