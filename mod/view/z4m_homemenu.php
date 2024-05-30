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
 * ZnetDK 4 Mobile Home Menu module view
 *
 * File version: 1.0
 * Last update: 05/30/2024
 */
$menulogoWidth = MOD_Z4M_HOMEMENU_PANEL_ICON_WIDTH;
$colDef = MOD_Z4M_HOMEMENU_COLUMN_DEFINITION;
$maxPanelsPerRow = MOD_Z4M_HOMEMENU_MAX_PANELS_PER_ROW;
$currentViewName = basename(__FILE__, '.php');
$allowedMenus = MenuManager::getAllowedMenuItems();
$allMenuItems = [];
if ($allowedMenus === FALSE
        || (is_array($allowedMenus) && count($allowedMenus) < 2)) {
    // No menu to display
} else {
    $allMenuItems = MenuManager::getMenuItems();
    $l1MenuCount = 0;
    foreach ($allMenuItems as $key => $menuDef) { // Level 1 Menu count calculation
        if ($menuDef[0] === $currentViewName ||
                (is_array($allowedMenus) && !in_array($menuDef[0], $allowedMenus))) {
            continue; // Home view is excluded or menu item not allowed
        }
        $l1MenuCount++;
    }
    $colClasses = $colDef[$l1MenuCount > $maxPanelsPerRow ? $maxPanelsPerRow : $l1MenuCount];
}
?>
<div class="<?php echo $l1MenuCount < 3 ? 'w3-content' : ''; ?>">
<?php
$panelNbr = 0;
foreach ($allMenuItems as $key => $menuDef) :
    if ($menuDef[0] === $currentViewName ||
            (is_array($allowedMenus) && !in_array($menuDef[0], $allowedMenus))) {
        continue; // Home view is excluded or menu item not allowed
    }
    $isNewRow = $panelNbr%$maxPanelsPerRow === 0;
    if ($isNewRow && $panelNbr > 0) : ?>
    </div>
<?php endif;
    if ($isNewRow) : ?>
    <div class="w3-row-padding w3-center w3-margin-top w3-stretch">
<?php endif; ?>
        <div class="w3-col <?php echo $colClasses; ?>">
            <div class="w3-border w3-border-theme w3-margin-bottom">
                <div class="w3-padding-32 w3-theme-d1">
                    <i class="fa <?php echo $menuDef[3]; ?> w3-margin" style="font-size: <?php echo $menulogoWidth; ?>"></i>
                    <div class="w3-xxlarge"><?php echo $menuDef[1]; ?></div>
                </div>
                <div class="w3-bar-block w3-xlarge w3-theme-action" style="margin-top:2px">
<?php
    $panelNbr++;
    $subItems = is_array($menuDef[2]) ? $menuDef[2] : [$menuDef];
    foreach ($subItems as $menuItem) : ?>
                <a onclick="znetdkMobile.content.displayView('<?php echo $menuItem[0]; ?>');" class="w3-bar-item w3-button w3-hover-theme"><i class="fa <?php echo $menuItem[3]; ?>"></i>&nbsp;<?php echo $menuItem[1]; ?></a>
<?php endforeach; ?>
                </div>
            </div>
        </div>
<?php endforeach; ?>
    </div>
</div>