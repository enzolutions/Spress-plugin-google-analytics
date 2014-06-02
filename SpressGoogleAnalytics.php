<?php

namespace SpressPlugins\SpressGoogleAnalytics;

use Yosymfony\Spress\Plugin\Plugin;
use Yosymfony\Spress\Plugin\EventSubscriber;
use Yosymfony\Spress\Plugin\Event\EnviromentEvent;

class SpressGoogleAnalytics extends Plugin
{
    public function initialize(EventSubscriber $subscriber)
    {
      die('here');
      $subscriber->addEventListener('spress.after_render', 'onAfterRender');
    }

    public function onAfterRender(RenderEvent $event)
    {

      $config = $event->getConfigRepository();
      // Get the content without Front-matter (string):
      $content = $event->getContent();
      print_r($content);
    }
}
