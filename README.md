Spress Google Analytics is a plugin for <a target="_blank" href="http://spress.yosymfony.com/">Spress</a> to enable use Google Analytics as tracking system.

## How to install?

Go to your Spress site and add the following to your `composer.json` and run
`composer update`:

```
"require": {
    "enzolutions/spress-plugin-google-analytics": "1.0.*@dev"
}
```

### How to use?

Add in your config.yml your Google Analytics configuration

````
google_analytics:
    id: UA-17944133-1
    site: YOURSITE.COM
````

Next time do you generate your site, all pages will have the Google Analytics Tracker code.
