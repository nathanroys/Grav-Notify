# Grav Notify
Grav Notify is a simple Grav plugin created to allow Bootstrap notifications to be shown. This plugin uses the 'frontmatter' of a page to initiate a notification and you can customise some aspects of the notification.
## Installation
To install the plugin you must copy the plugin to the plugins folder. 

> user/plugins

## Usage
Once installed notifications can be created by adding a combination of some variables in the frontmatter of the page, the available options are listed below.
> message - The message to display in the nofication **(Required)**
> type - The type of message **(Required)** *(info, warning, success, danger)*
> delay - The number of milliseconds to remain displayed
> dismissable - If the user can dismiss the notification *(true/false)*
> offset.from - Where to show the notification from *(top/bottom)*
> offset.amount - The amount of pixels to offset

    notify:
	    message: 'This is a warning'
	    type: warning
	
Above code shows bare minimum required to show a notification.

    notify:
    message: 'Hello world!!!!'
    type: warning
    delay: 6000
    dismissable: false
    position: left
    offset:
        from: top
        amount: 25

Above code shows all options in use.

## Contributing
1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D
## History
01/03/2017 - Released on GitHub
## Credits
[bootstrap-growl](https://github.com/ifightcrime/bootstrap-growl) by [Nick Larson](https://github.com/ifightcrime)
[Grav](https://github.com/getgrav/grav)