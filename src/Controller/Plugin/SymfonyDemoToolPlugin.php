<?php

namespace MelisPlatformFrameworkSymfonyDemoTool\Controller\Plugin;


use MelisEngine\Controller\Plugin\MelisTemplatingPlugin;
use Laminas\View\Model\ViewModel;

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
 * $plugin = $this->SymfonyDemoToolPlugin();
 * $pluginView = $plugin->render();
 *
 * How to call this plugin with custom parameters:
 * $plugin = $this->SymfonyDemoToolPlugin();
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
class SymfonyDemoToolPlugin extends MelisTemplatingPlugin
{
    public function __construct($updatesPluginConfig = [])
    {
        $this->configPluginKey = 'melisplatformframeworksymfonydemotool';
        $this->pluginXmlDbKey = 'MelisPlatformFrameworkSymfonyDemoTool';

        parent::__construct($updatesPluginConfig);
    }

    public function front()
    {
        $this->getServiceManager()->get('MelisPlatformService')->setRoute('/symfony-plugin');
        $albumListContent = $this->getServiceManager()->get('MelisPlatformService')->getContent();

        $data = $this->getFormData();

        // Create an array with the variables that will be available in the view
        $viewVariables = array(
            'pluginId'      => $data['id'],
            'albumList' => $albumListContent,
        );

        return $viewVariables;
    }

    /**
     * This function generates the form displayed when editing the parameters of the plugin
     */
    public function createOptionsForms()
    {
        // construct form
        $formConfig = $this->pluginBackConfig['modal_form'];

        $render   = [];
        if (!empty($formConfig)) {
            foreach ($formConfig as $formKey => $config) {
                $request = $this->getServiceManager()->get('request');
                $parameters = $request->getQuery()->toArray();

                if (!isset($parameters['validate'])) {
                    $viewModelTab = new ViewModel();
                    $viewModelTab->setTemplate($config['tab_form_layout']);

                    $viewRender = $this->getServiceManager()->get('ViewRenderer');
                    $html = $viewRender->render($viewModelTab);
                    array_push($render, [
                            'name' => $config['tab_title'],
                            'icon' => $config['tab_icon'],
                            'html' => $html,
                            //to hide the apply button of the modal
                            'empty' => 'empty'
                        ]
                    );
                }
            }
        }

        return $render;

    }

    /**
     * @return array|bool|null
     */
    public function getFormData()
    {
        return parent::getFormData();
    }

    /**
     * This method saves the XML version of this plugin in DB, for this pageId
     * Automatically called from savePageSession listener in PageEdition
     */
    public function savePluginConfigToXml($parameters)
    {
        $xmlValueFormatted = '';
        // template_path is mandatory for all plugins
        if (!empty($parameters['template_path']))
            $xmlValueFormatted .= "\t\t" . '<template_path><![CDATA[' . $parameters['template_path'] . ']]></template_path>';
        // for resizing
        $widthDesktop = null;
        $widthMobile   = null;
        $widthTablet  = null;
        if (! empty($parameters['melisPluginDesktopWidth'])) {
            $widthDesktop =  " width_desktop=\"" . $parameters['melisPluginDesktopWidth'] . "\" ";
        }
        if (! empty($parameters['melisPluginMobileWidth'])) {
            $widthMobile =  "width_mobile=\"" . $parameters['melisPluginMobileWidth'] . "\" ";
        }
        if (! empty($parameters['melisPluginTabletWidth'])) {
            $widthTablet =  "width_tablet=\"" . $parameters['melisPluginTabletWidth'] . "\" ";
        }
        // Something has been saved, let's generate an XML for DB
        $xmlValueFormatted = "\t" . '<' . $this->pluginXmlDbKey . ' id="' . $parameters['melisPluginId'] . '"' .$widthDesktop . $widthMobile . $widthTablet . '>' .
            $xmlValueFormatted .
            "\t" . '</' . $this->pluginXmlDbKey . '>' . "\n";
        return $xmlValueFormatted;
    }
}

