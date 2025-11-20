# CHANGE LOG: Home Menu (z4m_homemenu)

## Version 2.2, 2025-11-09
- BUG FIXING: On medium screen, when the constant MOD_Z4M_HOMEMENU_MAX_PANELS_PER_ROW was set to 4,
  the menu panels on the same row did not have the same height.

## Version 2.1, 2025-10-20
- BUG FIXING: a monitoring panel was displayed multiple times when the same path
  was configured multiple times in the MOD_Z4M_HOMEMENU_MONITORING_BOXES constant with different user profiles.

## Version 2.0, 2025-09-01
- BUG FIXING: the outline of the focused menu item is reduced for a better visibility.

## Version 1.9, 2025-07-29
- BUG FIXING: extra space were displayed under the level 2 menu items when the current logged in user was not allowed
  to access to all existing menu items defined in the 'menu.php' of the application.

## Version 1.8, 2025-06-20
- BUG FIXING: the level 2 menu items were not aligned vertically (CSS class `fa-fw` added to the menu icons).

## Version 1.7, 2025-06-14
- BUG FIXING: the keyboard focus outline was no longer displayed on level 2 menu items.

## Version 1.6, 2025-06-06
- CHANGE: the monitoring panel is no longer displayed when the MOD_Z4M_HOMEMENU_MONITORING_BOXES constant is configured
  in case no monitoring boxes should be displayed for the logged in user because they do not have the expected user profile.
- CHANGE: display optimization when the total number of menu panels to show for the logged in user is lower than the maximum
  menu panels per row defined via the MOD_Z4M_HOMEMENU_MAX_PANELS_PER_ROW constant.

## Version 1.5, 2025-05-22
- CHANGE: new monitoring panel added to the home page if the MOD_Z4M_HOMEMENU_MONITORING_BOXES constant is configured.
- BUG FIXING: when no icon were defined for a level 1 menu item, its panel height were lower than the others panels displayed with an icon.
- BUG FIXING: too long level 1 menu item labels were displayed on multiple lines, so its panel height were higher than the others panels.

## Version 1.4, 2025-01-03
- BUG FIXING: submenu items for which the user does not have permission were displayed instead of being masked.

## Version 1.3, 2024-10-20
- CHANGE: MOD_Z4M_HOMEMENU_COLOR_SCHEME PHP constant to customize the colors of
  the home menu.
- BUG FIXING: the home menu items were not focusable.

## Version 1.2, 2024-08-02
- CHANGE: new MOD_Z4M_HOMEMENU_EXCLUDED_VIEW PHP constant to customize the name
  of the view to exclude from the home.

## Version 1.1, 2024-07-04
- CHANGE: the cells displaying the level 2 menu items have now the same height
  on medium and large screens.

## Version 1.0, 2024-05-30
First version.