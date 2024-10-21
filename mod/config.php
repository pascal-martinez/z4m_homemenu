<?php
/**
 * ZnetDK, Starter Web Application for rapid & easy development
 * See official website https://mobile.znetdk.fr
 * Copyright (C) 2024 Pascal MARTINEZ (contact@znetdk.fr)
 * License GNU GPL https://www.gnu.org/licenses/gpl-3.0.html GNU GPL
 * --------------------------------------------------------------------
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 * --------------------------------------------------------------------
 * Parameters of the ZnetDK 4 Mobile Home Menu module
 *
 * File version: 1.2
 * Last update: 10/20/2024
 */

/**
 * Sets the maximum number of panels displayed per row
 * @var int Min value 1, max value 4 (default value).
 */
define('MOD_Z4M_HOMEMENU_MAX_PANELS_PER_ROW', 4);

/**
 * Sets the width of the menu item icons displayed in each menu panel
 * @var string Value '100px' by default.
 */
define('MOD_Z4M_HOMEMENU_PANEL_ICON_WIDTH', '100px');

/**
 * Name of the view to exclude from the home menu.
 * @var string Name of the view. If NULL, 'z4m_homemenu' is the exclude view
 * name.
 */
define('MOD_Z4M_HOMEMENU_EXCLUDED_VIEW', NULL);

/**
 * Color scheme of the home menu.
 * @var array|NULL Colors used to display the home menu. The expected array keys
 * are 'banner', 'content', 'btn_action' and 'btn_hover'.
 * If NULL, the color CSS classes applied are: 'w3-theme-d2' for 'banner', 
 * 'w3-theme-light' for 'content', 'w3-theme-action' for 'btn_action' and 
 * 'w3-hover-theme' for 'btn_hover'.
 * Example: [
 *   'banner' => 'w3-theme-d1',
 *   'content' => 'w3-theme-light',
 *   'btn_action' => 'w3-theme-action',
 *   'btn_hover' => 'w3-hover-theme'
 * ] 
 */
define('MOD_Z4M_HOMEMENU_COLOR_SCHEME', NULL);

/**
 * Module version number
 * @var string Version
 */
define('MOD_Z4M_HOMEMENU_VERSION_NUMBER','1.3');
/**
 * Module version date
 * @var string Date in W3C format
 */
define('MOD_Z4M_HOMEMENU_VERSION_DATE','2024-10-20');