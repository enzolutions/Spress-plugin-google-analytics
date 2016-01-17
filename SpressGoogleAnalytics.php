<?php

namespace SpressPlugins\SpressGoogleAnalytics;

use Yosymfony\Spress\Core\Plugin\PluginInterface;
use Yosymfony\Spress\Core\Plugin\EventSubscriber;
use Yosymfony\Spress\Core\Plugin\Event\EnvironmentEvent;
use Yosymfony\Spress\Core\Plugin\Event\RenderEvent;

class SpressGoogleAnalytics implements PluginInterface
{
    protected $googleAnalyticsID;
    protected $googleAnalyticsSite;

    public function initialize(EventSubscriber $subscriber)
    {
      $subscriber->addEventListener('spress.start', 'onStart');
      $subscriber->addEventListener('spress.after_render_page', 'onAfterRender');
    }

    public function getMetas()
    {
        return [
            'name' => 'enzolutions/spress-plugin-google-analytics',
            'description' => 'Enable Google Analytics as tracking system.',
            'author' => 'enzo - Eduardo Garcia',
            'license' => 'MIT',
        ];
    }


    public function onStart(EnvironmentEvent $event) {
        $configValues = $event->getConfigValues();

        if(isset($configValues['google_analytics'])) {
            $this->googleAnalyticsID = $configValues['google_analytics']['id'];
            $this->googleAnalyticsSite = $configValues['google_analytics']['site'];
        }
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


      // Validate if Google Analytics settigns are available.
      if(isset($this->googleAnalyticsID) && isset($this->googleAnalyticsSite)) {
        // Get content
        $content = $event->getContent();

        // Set google analytics variables
        $ga_code = str_replace('GA_ID', $this->googleAnalyticsID, $ga_code);
        $ga_code = str_replace('GA_SITE', $this->googleAnalyticsSite, $ga_code);

        // Append Google Analytics code to end of page
        $content= str_replace('</body>', $ga_code . "\n </body> ", $content);
        $event->setContent($content);
      }
    }
}
