<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class NotifyPlugin
 * @package Grav\Plugin
 */
class NotifyPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        // Enable the main event we are interested in
        $this->enable([
            'onPageContentRaw' => ['onPageContentRaw', 0]
        ]);
    }

    /**
     * Do some work for this event, full details of events can be found
     * on the learn site: http://learn.getgrav.org/plugins/event-hooks
     *
     * @param Event $e
     */
    public function onPageContentRaw(Event $e)
    {
        $page = $e['page'];
        $header = $page->header();

        if(isset($header->notify))
        {
          if(isset($header->notify['message']) && isset($header->notify['type']))
          {
            // Get the message and type from the frontmatter
            $message                =       $header->notify['message'];
            $type                   =       $header->notify['type'];
            $delay                  =       isset($header->notify['delay']) ? $header->notify['delay']  : "4000";
            $dismissable            =       isset($header->notify['dismissable']) ? ($header->notify['dismissable'] ? "true" : "false")  : "true";
            $position               =       isset($header->notify['align']) ? $header->notify['align']  : "right";
            $offsetFrom             =       isset($header->notify['offset']['from']) ? $header->notify['offset']['from']  : "bottom";
            $offsetAmount           =       isset($header->notify['offset']['amount']) ? $header->notify['offset']['amount']  : "20";

            // We now need to inject the notify assets
            $assets         = $this->grav['assets'];
            $notify_assets  = [
              'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js'
            ];
            $assets->registerCollection('notify', $notify_assets);
            $assets->add('notify', 0);

            // Append the notification to the output
            $assets->addInlineJs("
            $.bootstrapGrowl(\"" . $message . "\", {
              ele: 'body',
              type: '" . $type . "',
              offset: {from: '" . $offsetFrom . "', amount: " . $offsetAmount . "},
              align: '" . $position . "',
              width: 'auto',
              delay: " . $delay . ",
              allow_dismiss: " . $dismissable . ",
              stackup_spacing: 10
            });");
          }
        }

    }
}
