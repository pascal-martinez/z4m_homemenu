# CHANGE LOG: Home Menu (z4m_homemenu)

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