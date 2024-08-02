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
 * File version: 1.2
 * Last update: 08/02/2024
 */
$maxPanelsPerRow = MOD_Z4M_HOMEMENU_MAX_PANELS_PER_ROW;
$menulogoWidth = MOD_Z4M_HOMEMENU_PANEL_ICON_WIDTH;
// Column definition for medium and large screens
$colDefCss = [];
$colCountMedium = [];
for ($colIdx = 1; $colIdx <= 4; $colIdx++) {
    $colCountMedium[$colIdx] = (($colIdx-1)%2)+1;
    $mCols = 12/$colCountMedium[$colIdx];
    $lCols = 12/$colIdx;
    $colDefCss[$colIdx] = "m{$mCols} l{$lCols}";
}
// This view name
$currentViewName = MOD_Z4M_HOMEMENU_EXCLUDED_VIEW === NULL 
        ? basename(__FILE__, '.php') : MOD_Z4M_HOMEMENU_EXCLUDED_VIEW;
// Check configured value for the max number of panels per row
if ($maxPanelsPerRow < 1 || $maxPanelsPerRow > 4) {
    General::writeErrorLog($currentViewName, "Value '{$maxPanelsPerRow}' set for the number of max panels per row is invalid. Expected values are 1 to 4.");
    $maxPanelsPerRow = 2;
}
// Count the number of Level 1 and Level 2 menu items 
$allowedMenus = MenuManager::getAllowedMenuItems();
$allMenuItems = [];
if ($allowedMenus === FALSE
        || (is_array($allowedMenus) && count($allowedMenus) < 2)) {
    // No menu to display
} else {
    $allMenuItems = MenuManager::getMenuItems();
    $l1MenuCount = 0;
    $l2MenuCount = [];
    foreach ($allMenuItems as $key => $menuDef) { // Level 1 Menu count calculation
        if ($menuDef[0] === $currentViewName ||
                (is_array($allowedMenus) && !in_array($menuDef[0], $allowedMenus))) {
            continue; // Home view is excluded or menu item not allowed
        }
        $l1MenuCount++;
        $l2MenuCount[] = $subItems = is_array($menuDef[2]) ? count($menuDef[2]) : 1;
    }
    $colDefApplied = $l1MenuCount > $maxPanelsPerRow ? $maxPanelsPerRow : $l1MenuCount;
    $colClasses = $colDefCss[$colDefApplied];
    $colMedium = $colCountMedium[$colDefApplied];
}
?>
<style>
    #z4m-home-menu .level1-logo {
        font-size: <?php echo $menulogoWidth; ?>;
    }
    #z4m-home-menu .horizontal-divider {
        height: 2px;
    }
    #z4m-home-menu .level2-anchor {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
<div id="z4m-home-menu"<?php echo $l1MenuCount < 3 ? ' class="w3-content"' : ''; ?>>
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
    if ($isNewRow) : 
        $maxAnchorsPerLargeRow = max(array_slice($l2MenuCount, $panelNbr, $colDefApplied));
    ?>
    <div class="menu-row w3-row-padding w3-center w3-stretch">
<?php endif; ?>
        <div class="menu-col w3-col <?php echo $colClasses; ?> w3-section">
            <div class="w3-padding-32 w3-theme-d1">
                <i class="level1-logo fa <?php echo $menuDef[3]; ?> w3-margin"></i>
                <div class="w3-xxlarge"><?php echo $menuDef[1]; ?></div>
            </div>
            <div class="horizontal-divider w3-theme"></div>
            <div class="w3-bar-block w3-xlarge w3-theme-action">
<?php
    $subItems = is_array($menuDef[2]) ? $menuDef[2] : [$menuDef];
    foreach ($subItems as $menuItem) : ?>
            <a onclick="znetdkMobile.content.displayView('<?php echo $menuItem[0]; ?>');" class="level2-anchor w3-bar-item w3-button w3-hover-theme"><i class="fa <?php echo $menuItem[3]; ?>"></i>&nbsp;<?php echo $menuItem[1]; ?></a>
<?php endforeach;
for ($index = 0; $index < $maxAnchorsPerLargeRow - count($subItems); $index++) : ?>
            <div class="w3-bar-item w3-hide-medium w3-hide-small">&nbsp;</div>
<?php endfor;
if ($panelNbr%$colMedium === 0) {
    $maxAnchorsPerMediumRow = max(array_slice($l2MenuCount, $panelNbr, $colMedium));
}
for ($index = 0; $index < $maxAnchorsPerMediumRow - count($subItems); $index++) : ?>
            <div class="w3-bar-item w3-hide-large w3-hide-small">&nbsp;</div>
<?php endfor;
        $panelNbr++;
?>
            </div>
        </div>
<?php endforeach; ?>
    </div>
</div>