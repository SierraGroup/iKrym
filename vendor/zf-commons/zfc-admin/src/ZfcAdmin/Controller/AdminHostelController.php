<?php
namespace ZfcAdmin\Controller;



use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;


use Hostel\Form\HostelForm;
use Hostel\Model\Hostel;

use Hostel\Form\HostelNewsForm;
use Hostel\Model\HostelNews;

use Hostel\Form\HostelPosterForm;
use Hostel\Model\HostelPoster;



class AdminHostelController extends AbstractActionController
{
    //attractions table
    protected $hostelTable;
    protected $hostelNewsTable;
    protected $hostelPosterTable;

    public  function hostelAction(){
        $hostel_view = new ViewModel();

        $hostel_table = $this->getHostelTable()->fetchAll();

        $hostel_view->setVariable('hostels', $hostel_table);

        $admin_menu = new ViewModel();
        $admin_menu->setTemplate('zfc-admin/block/admin_menu');
        $hostel_view->addChild($admin_menu,'admin');

        $sidebar= new ViewModel();
        $sidebar->setTemplate('zfc-admin/block/sidebar_admin');
        $hostel_view->addChild($sidebar,'sidebar');
        return $hostel_view;
    }
    public function getHostelTable(){
        if (!$this->hostelTable) {
            $sm = $this->getServiceLocator();
            $this->hostelTable = $sm->get('Hostel\Model\HostelTable');
        }
        return $this->hostelTable;
    }
    public function getHostelNewsTable(){
        if (!$this->hostelNewsTable) {
            $sm = $this->getServiceLocator();
            $this->hostelNewsTable = $sm->get('Hostel\Model\HostelNewsTable');
        }
        return $this->hostelNewsTable;
    }
    public function getHostelPosterTable(){
        if (!$this->hostelPosterTable) {
            $sm = $this->getServiceLocator();
            $this->hostelPosterTable = $sm->get('Hostel\Model\HostelPosterTable');
        }
        return $this->hostelPosterTable;
    }


    public  function  hostelAddAction(){
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
                $this->getHostelTable()->saveHostel($hostel);

                // Form is valid, save the form!
                return $this->redirect()->toRoute('zfcadmin/hostels');
            }
        }
        //else return $this->redirect()->toRoute('zfcadmin');
        return array('form' => $form);
    }
    public  function  hostelNewsAddAction(){
        $form = new HostelNewsForm();

        $form->get('submit')->setValue('Добавить новость');
        $hostel_id_name = (string) $this->params()->fromRoute('hostel_id_name', 0);
        $form->get('hostel_id_name')->setValue($hostel_id_name);


        $request = $this->getRequest();

        if ($request->isPost()) {
            $hostel_news = new hostelNews();
            $form->setInputFilter($hostel_news->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if ($form->isValid()){

                $hostel_news->exchangeArray($form->getData());
                $this->gethostelNewsTable()->savehostelNews($hostel_news);

                // Form is valid, save the form!
                return $this->redirect()->toUrl('zfcadmin/hostels');
            }
        }
        //else return $this->redirect()->toRoute('zfcadmin');
        return array('form' => $form);
    }
    public  function  hostelDeleteAction(){
        $hostel_id = (int) $this->params()->fromRoute('hostel_id',0);
        if (!$hostel_id) {
            return $this->redirect()->toRoute('zfcadmin/hostels');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($hostel_id) {
                // $hostel_id = (int) $request->getPost('hostel_id');
                $this->getHostelTable()->deleteHostel($hostel_id);
                // Redirect to list of albums
                return $this->redirect()->toRoute('zfcadmin/hostels');
            }
        }
        return array(
            'hostel_id'    => $hostel_id,
            'hostel' => $this->gethostelTable()->gethostel($hostel_id)
        );
    }
    public  function  hostelEditAction()
    {
        $hostel_id_name = (string) $this->params()->fromRoute('hostel_id_name', 0);
        $hostel = $this->getHostelTable()->getHostelByNameId($hostel_id_name);

        $form  = new HostelForm();
        $form->bind($hostel);
        $form->get('submit')->setAttribute('value', 'Редактировать');

        // $request = $this->getRequest();
        if ($this->getRequest()->isPost()) {
            $form->setInputFilter($hostel->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );

            $form->setData($data);

            if ($form->isValid()) {
                $this->getHostelTable()->saveHostel($hostel);

                // Redirect to list of albums
                return $this->redirect()->toRoute('zfcadmin/hostels');
            }
        }
        return array(
            'hostel_id_name' => $hostel_id_name,
            'form' => $form,
        );
    }
    public  function  hostelPosterAddAction(){

        $form = new hostelPosterForm();

        $form->get('submit')->setValue('Добавить афишу');
        $hostel_id_name = (string) $this->params()->fromRoute('hostel_id_name', 0);
        $form->get('hostel_id_name')->setValue($hostel_id_name);


        $request = $this->getRequest();

        if ($request->isPost()) {
            $hostel_poster = new hostelPoster();
            $form->setInputFilter($hostel_poster->getInputFilter());

            // Make certain to merge the files info!
            $data= array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if ($form->isValid()){

                $hostel_poster->exchangeArray($form->getData());
                $this->getHostelPosterTable()->saveHostelPoster($hostel_poster);

                // Form is valid, save the form!
                return $this->redirect()->toUrl('zfcadmin/hostels');
            }
        }
        //else return $this->redirect()->toRoute('zfcadmin');
        return array('form' => $form);

    }
}