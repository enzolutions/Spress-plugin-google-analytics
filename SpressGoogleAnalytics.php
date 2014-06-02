<?php

namespace SpressPlugins\SpressGoogleAnalytics;

use Yosymfony\Spress\Plugin\Plugin;
use Yosymfony\Spress\Plugin\EventSubscriber;
use Yosymfony\Spress\Plugin\Event\EnviromentEvent;
use Yosymfony\Spress\Plugin\Event\RenderEvent;

class SpressGoogleAnalytics extends Plugin
{
    public function initialize(EventSubscriber $subscriber)
    {
      $subscriber->addEventListener('spress.after_render', 'onAfterRender');
    }

    public function onAfterRender(RenderEvent $event)
    {

      $payload = $event->getPayload();

      // Site Configuration
      //$payload['site']);

      // Page Content
      // $payload['page']['content']);

    }
}
