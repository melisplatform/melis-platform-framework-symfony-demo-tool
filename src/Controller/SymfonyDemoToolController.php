<?php

namespace MelisPlatformFrameworkSymfonyDemoTool\Controller;

use Laminas\View\Model\ViewModel;
use MelisCore\Controller\AbstractActionController;

class SymfonyDemoToolController extends AbstractActionController
{
    /**
     * @return \Zend\View\Model\ViewModel
     */
    public function renderSymfonyDemoToolAction()
    {
        $view = new ViewModel();
        $view->melisKey = $this->getMelisKey();
        $this->getServiceManager()->get('MelisPlatformService')->setRoute('/melis/symfony-list');
        $view->symfonyView = $this->getServiceManager()->get('MelisPlatformService')->getContent();
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