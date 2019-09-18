<?php

namespace MelisPlatformFrameworkSymfonyDemoTool\Controller\Plugin;


use MelisEngine\Controller\Plugin\MelisTemplatingPlugin;
use Zend\View\Model\ViewModel;

/**
 * This plugin implements the business logic of the
 * "Tag" plugin.
 *
 * Please look inside app.plugins.php for possible awaited parameters
 * in front and back function calls.
 *
 * front() and back() are the only functions to create / update.
 * front() generates the website view
 * back() generates the plugin view in template edition mode (TODO)
 *
 * Configuration can be found in $pluginConfig / $pluginFrontConfig / $pluginBackConfig
 * Configuration is automatically merged with the parameters provided when calling the plugin.
 * Merge detects automatically from the route if rendering must be done for front or back.
 *
 * How to call this plugin without parameters:
 * $plugin = $this->MelisPlatformFrameworkSymfonyDemoToolPlugin();
 * $pluginView = $plugin->render();
 *
 * How to call this plugin with custom parameters:
 * $plugin = $this->MelisPlatformFrameworkSymfonyDemoToolPlugin();
 * $parameters = array(
 *      'template_path' => 'MySiteTest/tag/tag'
 * );
 * $pluginView = $plugin->render($parameters);
 *
 * How to add to your controller's view:
 * $view->addChild($pluginView, 'tag_01');
 *
 * How to display in your controller's view:
 * echo $this->tag_01;
 *
 *
 */
class MelisPlatformFrameworkSymfonyDemoToolPlugin extends MelisTemplatingPlugin
{
    public function __construct($updatesPluginConfig = [])
    {
        $this->configPluginKey = 'melisplatformframeworksymfonydemotool';
        $this->pluginXmlDbKey = 'MelisPlatformFrameworkSymfonyDemoTool';

        parent::__construct($updatesPluginConfig);
    }

    public function front()
    {
        $this->getServiceLocator()->get('MelisPlatformService')->setRoute('/symfony-plugin');
        $albumTable = $this->getServiceLocator()->get('MelisPlatformService')->getContent();

        // Create an array with the variables that will be available in the view
        $viewVariables = array(
            'albumList' => $albumTable,
        );

        return $viewVariables;
    }
}

