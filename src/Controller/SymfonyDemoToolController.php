<?php

namespace MelisPlatformFrameworkSymfonyDemoTool\Controller;

use Laminas\View\Model\ViewModel;
use MelisCore\Controller\MelisAbstractActionController;

class SymfonyDemoToolController extends MelisAbstractActionController
{
    /**
     * @return \Zend\View\Model\ViewModel
     */
    public function renderSymfonyDemoToolAction()
    {
        session_write_close();
        ini_set('max_execution_time', 0);
        set_time_limit(0);
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
