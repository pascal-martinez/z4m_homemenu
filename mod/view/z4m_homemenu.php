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
 * ZnetDK 4 Mobile Home Menu module view fragment
 *
 * File version: 1.8
 * Last update: 09/01/2025
 */

/* Color Scheme */
$color = [
    'banner' => 'w3-theme-d2',
    'content' => 'w3-theme-light',
    'btn_action' => 'w3-theme-action',
    'btn_hover' => 'w3-hover-theme',
    'nav_menu_bar_select' => 'w3-border-theme'
];
if (is_array(MOD_Z4M_HOMEMENU_COLOR_SCHEME)) {
    $color = MOD_Z4M_HOMEMENU_COLOR_SCHEME;
} elseif (defined('CFG_MOBILE_W3CSS_THEME_COLOR_SCHEME')) {
    $color = CFG_MOBILE_W3CSS_THEME_COLOR_SCHEME;
}
// Home menu definition
$homeMenu = new z4m_homemenu\mod\HomeMenu();
// Calculation of the font size viewport factor 
$panelTitleViewWidth = 4 - $homeMenu->getPanelCountPerRow() + (($homeMenu->getPanelCountPerRow()-1)/2);
$menuTitleViewWidth = 4 - $homeMenu->getPanelCountPerRow() 
        + (($homeMenu->getPanelCountPerRow()-1)/2.5) - ((4 - $homeMenu->getPanelCountPerRow())*0.2);
?>
<style>
    #z4m-home-menu .level1 .logo {
        font-size: <?php echo $homeMenu->getPanelIconWidth(); ?>;
    }
    #z4m-home-menu .level1 .missing-logo {
        width: <?php echo $homeMenu->getPanelIconWidth(); ?>;
        height: <?php echo $homeMenu->getPanelIconWidth(); ?>;
    }
    #z4m-home-menu .level1 .title {
        font-size: 36px;
    }
    #z4m-home-menu .level2 {
        font-size: 24px;
    }
    @media (min-width:993px){
        #z4m-home-menu .level1 .title {
            font-size: clamp(16px, <?php echo $panelTitleViewWidth; ?>vw, 36px);
        }
        #z4m-home-menu .level2 {
            font-size: clamp(14px, <?php echo $menuTitleViewWidth; ?>vw, 24px);
        }
    }
    #z4m-home-menu .horizontal-divider {
        height: 2px;
    }
    #z4m-home-menu .level1 .title,
    #z4m-home-menu .level2 .anchor {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    #z4m-home-menu .level2 .anchor:focus-visible {
        outline-offset:-4px;
    }
</style>
<?php
/* Monitoring boxes display if defined */
if ($homeMenu->getMonitoringBoxCountToDisplayForLoggedInUser() > 0) : ?>
<div class="w3-row-padding w3-stretch">
    <div class="w3-col s12 m12 l3 w3-margin-top">
        <div class=" w3-padding w3-large <?php echo $color['banner']; ?>">
            <i class="fa fa-flag"></i>
            <?php echo MOD_Z4M_HOMEMENU_MONITORING_TITLE; ?>
            <a id="z4m_homemenu-refresh" class="w3-right" href="#">
                <i class="fa fa-refresh" title="<?php echo MOD_Z4M_HOMEMENU_MONITORING_REFRESH_TITLE; ?>"></i>
            </a>
        </div>
<?php
$monitoringBoxPaths = $homeMenu->getMonitoringBoxPaths();
foreach ($monitoringBoxPaths as $boxPath) {
    require $boxPath;
}
?>
    </div>
    <div class="w3-col s12 m12 l9">
<?php require 'fragment/homemenu.php'; ?>
    </div>
</div>
<script>
(function(){
    $('#z4m_homemenu-refresh').on('click.z4m_homemenu', function(e) {
        e.preventDefault();
        z4m.content.reloadView(z4m.content.getDisplayedViewId());
    });
})();
</script>
<?php else : require 'fragment/homemenu.php';
endif;