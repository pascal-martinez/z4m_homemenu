# ZnetDK 4 Mobile module: Home Menu (z4m_homemenu)
The **z4m_homemenu** displays a dynamic 2 levels menu on the home view according
to the rights granted to the logged in user.

![Screenshot of the Home Menu view provided by the ZnetDK 4 Mobile 'z4m_homemenu' module](https://mobile.znetdk.fr/applications/default/public/images/modules/z4m_homemenu/screenshot.png?v1.1)
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

## CUSTOMIZATION
The home menu can be customized by settings the following PHP constants in the [`config.php`](/../../../znetdk4mobile/blob/master/applications/default/app/config.php) script of the application:
- `MOD_Z4M_HOMEMENU_MAX_PANELS_PER_ROW`: the maximum number of panels displayed per row (value `4` by default).
- `MOD_Z4M_HOMEMENU_PANEL_ICON_WIDTH`: the width of the menu item icons displayed in each menu panel (value `'100px'`).
- `MOD_Z4M_HOMEMENU_EXCLUDED_VIEW`: name of the view to exclude from the home menu (value `'z4m_homemenu'` by default).
- `MOD_Z4M_HOMEMENU_COLOR_SCHEME`: color scheme of the home menu. The color CSS classes applied by default are: `'w3-theme-d2'` for `'banner'`, `'w3-theme-light'` for `'content'`, `'w3-theme-action'` for `'btn_action'` and `'w3-hover-theme'` for `'btn_hover'`.
- `MOD_Z4M_HOMEMENU_MONITORING_BOXES`: since **version 1.5** of the module, the paths of the monitoring boxes php scripts to show on the home page (see chapter below for precisions).

## DISPLAYING MONITORING BOXES ON THE HOME MENU
Since **version 1.5** of the **z4m_homemenu** module, **monitoring boxes** can be displayed on the home menu as shown on the screenshot below.

![Screenshot of the Home Menu Monitoring boxes](https://mobile.znetdk.fr/applications/default/public/images/modules/z4m_homemenu/screenshot2.png?v1.1)

A box is displayed by calling the PHP script whose path was configured via the `MOD_Z4M_HOMEMENU_MONITORING_BOXES` constant.  
A monitoring box template named [`box_sample.php`](mod/view/fragment/box_sample.php) is provided as an example.  
In addition, visibility of the boxes can be restricted to users having a given user profile.  
Here is below an example of configuration for displaying multiple monitoring boxes.  
```php
define('MOD_Z4M_HOMEMENU_MONITORING_BOXES', [
    ['boxPath' => 'z4m_storage/mod/view/fragment/homemenu_storage.php'],
    ['boxPath' => 'z4m_smssending/mod/view/fragment/homemenu_credit_balance.php']
]);
```
To display the `box_sample.php` box only for users having the "Manager" user profile, the configuration is shown below:  
```php
define('MOD_Z4M_HOMEMENU_MONITORING_BOXES', [
    ['boxPath' => 'z4m_homemenu/mod/view/fragment/box_sample.php', 'userProfile' => 'Manager']
]);
```
To display the `box_sample.php` box only for users having the "Manager" or "Accounting" user profiles, the configuration is shown below:  
```php
define('MOD_Z4M_HOMEMENU_MONITORING_BOXES', [
    ['boxPath' => 'z4m_homemenu/mod/view/fragment/box_sample.php', 'userProfile' => 'Manager'],
    ['boxPath' => 'z4m_homemenu/mod/view/fragment/box_sample.php', 'userProfile' => 'Accounting']
]);
```

## CHANGE LOG
See [CHANGELOG.md](CHANGELOG.md) file.

## CONTRIBUTING
Your contribution to the **ZnetDK 4 Mobile** project is welcome. Please refer to the [CONTRIBUTING.md](https://github.com/pascal-martinez/znetdk4mobile/blob/master/CONTRIBUTING.md) file.
