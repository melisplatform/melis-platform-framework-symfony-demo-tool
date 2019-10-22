<?php

namespace MelisPlatformFrameworkSymfonyDemoTool\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SymfonyDemoToolController extends AbstractActionController
{
    /**
     * @return \Zend\View\Model\ViewModel
     */
    public function renderSymfonyDemoToolAction()
    {
        $view = new ViewModel();
        $view->melisKey = $this->getMelisKey();
        $this->serviceLocator->get('MelisPlatformService')->setRoute('/melis/symfony-list');
        $view->symfonyView = $this->serviceLocator->get('MelisPlatformService')->getContent();
        return $view;
    }

    /**
     * @return ViewModel
     */
    public function renderAlbumModalHandlerAction()
    {
        $id = $this->params()->fromRoute('id', $this->params()->fromQuery('id', ''));
        $view = new ViewModel();
        $view->melisKey = $this->getMelisKey();
        $view->id = $id;
        return $view;
    }

    /**
     * @return ViewModel
     */
    public function renderAlbumModalAction()
    {
        $view = new ViewModel();
        /**
         * get the form from
         * the symfony
         */
        $albumId = $this->params()->fromQuery('id', $this->params()->fromQuery('album_id', 0));
        $this->serviceLocator->get('MelisPlatformService')->setRoute('/melis/create-form/'.$albumId);
        $view->form = $this->serviceLocator->get('MelisPlatformService')->getContent();

        $view->melisKey  = $this->getMelisKey();
        $view->albumId = $albumId;
        return $view;
    }

    /**
     * returns meliskey from route or from query
     * @return mixed
     */
    private function getMelisKey()
    {
        $melisKey = $this->params()->fromRoute('melisKey', $this->params()->fromQuery('melisKey'), null);

        return $melisKey;
    }
}