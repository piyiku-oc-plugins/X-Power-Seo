<?php namespace Bayuaji\ExtPowerSEO;

use Event;
use System\Classes\PluginBase;
use System\Classes\PluginManager;


class Plugin extends PluginBase
{
    public $require = [
        'SureSoftware.PowerSEO'
    ];

    public function registerComponents()
    {
        return [];
    }

    public function registerSettings()
    {
    }

    function boot()
    {
        Event::listen('backend.form.extendFields', function($widget) {
            if (PluginManager::instance()->hasPlugin('SureSoftware.PowerSEO') && $widget->model instanceof \RainLab\Blog\Models\Post) {
                if ($widget->isNested) {
                    return;
                }          

               
                $widget->addFields([
                    'powerseo_title' => [
                        'label' => 'suresoftware.powerseo::lang.editor.meta_title',
                        'type' => 'text',
                        'tab' => 'SEO',
                        'preset' => [
                            'field' => 'title',
                            'type' => 'exact'
                        ],
                    ],
                    'powerseo_description' => [
                        'label' => 'suresoftware.powerseo::lang.editor.meta_description',
                        'type' => 'textarea',
                        'size' => 'tiny',
                        'tab' => 'SEO',
                        'preset' => [
                            'field' => 'excerpt',
                            'type' => 'exact'
                        ],
                    ],                    

                ],'secondary');
            }

            if (PluginManager::instance()->hasPlugin('SureSoftware.PowerSEO') && $widget->model instanceof \RainLab\Pages\Classes\Page) {
                if ($widget->isNested) {
                    return;
                }    
                            
                $widget->addFields([
                    'viewBag[meta_title]' => [
                        'label' => 'cms::lang.editor.meta_title',
                        'type' => 'text',
                        'tab' => 'cms::lang.editor.meta',
                        'preset' => [
                            'field' => 'viewBag[title]',
                            'type' => 'exact'
                        ],
                    ],
                    'viewBag[seo_title]' => [
                        'label' => 'suresoftware.powerseo::lang.editor.meta_title',
                        'type' => 'text',
                        'tab' => 'cms::lang.editor.meta',
                        'cssClass' => 'hidden',
                        'preset' => [
                            'field' => 'viewBag[title]',
                            'type' => 'exact'
                        ],
                    ],
                    'viewBag[seo_description]' => [
                        'label' => 'suresoftware.powerseo::lang.editor.meta_title',
                        'type' => 'text',
                        'tab' => 'cms::lang.editor.meta',
                        'cssClass' => 'hidden',
                        'preset' => [
                            'field' => 'viewBag[meta_description]',
                            'type' => 'exact'
                        ],
                    ],
                    
                ],
                    'primary');
            }
        });
        // dd("ada");
    }

    private function getIndexOptions()
    {
        return ["index" => "index", "noindex" => "noindex"];
    }

    private function getFollowOptions()
    {
        return ["follow" => "follow", "nofollow" => "nofollow"];
    }
    
}
