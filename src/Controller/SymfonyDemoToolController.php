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
        $this->serviceLocator->get('MelisPlatformService')->setRoute('/list');
        $view->symfonyView = $this->serviceLocator->get('MelisPlatformService')->getContent();
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