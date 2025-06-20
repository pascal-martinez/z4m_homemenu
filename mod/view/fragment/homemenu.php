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
 * File version: 1.1
 * Last update: 06/20/2025
 */
$menuContainerClass = $homeMenu->getPanelCountPerRow() < 3 ? ' class="w3-content"' : '';
$colClasses = $homeMenu->getColumnDefinitionClasses();
?>
<div id="z4m-home-menu"<?php echo $menuContainerClass; ?>>
<?php
$panelRows = $homeMenu->getMenuPanelRows();
foreach ($panelRows as $rowPanels) /* ROWS */: ?>
    <div class="menu-row w3-row-padding w3-center w3-stretch">
<?php
    foreach ($rowPanels as $panel) /* PANELS */ : ?>
        <div class="menu-col w3-col <?php echo $colClasses; ?> w3-section">
            <div class="level1 w3-padding-32 <?php echo $color['banner']; ?>">
<?php if (strlen($panel['icon']) > 0) : ?>
                <i class="logo fa <?php echo $panel['icon']; ?> w3-margin"></i>
<?php else : ?>
                <div class="missing-logo w3-margin"></div>
<?php endif; ?>
                <div class="title w3-padding-small"><?php echo $panel['title']; ?></div>
            </div>
            <div class="horizontal-divider <?php echo $color['content']; ?>"></div>
            <div class="level2 w3-bar-block <?php echo $color['btn_action']; ?>">
<?php
        foreach ($panel['menuItems'] as $menuItem) /* MENU ITEMS */ : ?>
            <a href="javascript:void(0)" onclick="znetdkMobile.content.displayView('<?php echo $menuItem['viewName']; ?>');" class="anchor w3-bar-item w3-button <?php echo $color['btn_hover']; ?>">
                <i class="fa fa-fw <?php echo $menuItem['icon']; ?>"></i>&nbsp;<?php echo $menuItem['title']; ?>
            </a>
<?php
        endforeach; /* MENU ITEMS */
        for ($index = 0; $index < $panel['largeRowSpacerCount']; $index++) : ?>
                    <div class="w3-bar-item w3-hide-medium w3-hide-small">&nbsp;</div>
        <?php
        endfor;
        for ($index = 0; $index < $panel['mediumRowSpacerCount']; $index++) : ?>
                    <div class="w3-bar-item w3-hide-large w3-hide-small">&nbsp;</div>
        <?php
        endfor; ?>
            </div>
        </div>
<?php
    endforeach; /* PANELS */
?>
    </div>
<?php
endforeach; /* ROWS */ ?>
</div>