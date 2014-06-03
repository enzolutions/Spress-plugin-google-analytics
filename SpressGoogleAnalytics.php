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

      // Google Analytics Content.
      $ga_code = "
      <!-- Google Analytics Tracker -->
      <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'GA_ID', 'GA_SITE');
        ga('send', 'pageview');
      </script>
      <!-- End of Google Analytics Tracker -->";

      $payload = $event->getPayload();

      // Validate if Google Analytics settigns are available.
      if(isset($payload['site']['google_analytics']['id']) && isset($payload['site']['google_analytics']['site'])) {
        // Get content
        $content = $event->getContent();

        // Set google analytics variables
        $ga_code = str_replace('GA_ID', $payload['site']['google_analytics']['id'], $ga_code);
        $ga_code = str_replace('GA_SITE', $payload['site']['google_analytics']['site'], $ga_code);

        // Append Google Analytics code to end of page
        $content = str_replace('</body>', $ga_code . "\n </body> ", $content);
        $event->setContent($content);
      }
    }
}
