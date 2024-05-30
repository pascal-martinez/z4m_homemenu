# ZnetDK 4 Mobile module: Home Menu (z4m_homemenu)
The **z4m_homemenu** displays a dynamic 2 levels menu on the home view according
to the rights granted to the logged in user.

![Screenshot of the Home Menu view provided by the ZnetDK 4 Mobile 'z4m_homemenu' module](https://mobile.znetdk.fr/applications/default/public/images/modules/z4m_homemenu/screenshot.png?v1.0)
## LICENCE
This module is published under the version 3 of GPL General Public Licence.

## FEATURES
This module contains the view `z4m_homemenu` to declare within the
[`menu.php`](/../../../znetdk4mobile/blob/master/applications/default/app/menu.php) of the
application.  
If user authentication is disabled, all the menu items are displayed by the
`z4m_homemenu` view.   
This view can also be included within an existing home view.

## REQUIREMENTS
- [ZnetDK 4 Mobile](/../../../znetdk4mobile) version 2.0 or higher,
- PHP version 7.4 or higher.

## INSTALLATION
1. Add a new subdirectory named `z4m_homemenu` within the
[`./engine/modules/`](/../../../znetdk4mobile/tree/master/engine/modules/) subdirectory of your
ZnetDK 4 Mobile starter App,
2. Copy module's code in the new `./engine/modules/z4m_homemenu/` subdirectory,
or from your IDE, pull the code from this module's GitHub repository,
3. Edit the App's [`menu.php`](/../../../znetdk4mobile/blob/master/applications/default/app/menu.php)
located in the [`./applications/default/app/`](/../../../znetdk4mobile/tree/master/applications/default/app/)
subfolder and add a new menu item definition for the view `z4m_homemenu` as first menu item.
For example:  
```php
\MenuManager::addMenuItem(NULL, 'z4m_homemenu', 'Home', 'fa-home');
```

## CHANGE LOG
See [CHANGELOG.md](CHANGELOG.md) file.

## CONTRIBUTING
Your contribution to the **ZnetDK 4 Mobile** project is welcome. Please refer to the [CONTRIBUTING.md](https://github.com/pascal-martinez/znetdk4mobile/blob/master/CONTRIBUTING.md) file.
