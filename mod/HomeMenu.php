<?php

/*
 * ZnetDK, Starter Web Application for rapid & easy development
 * See official website https://www.znetdk.fr
 * Copyright (C) 2025 Pascal MARTINEZ (contact@znetdk.fr)
 * License GNU GPL http://www.gnu.org/licenses/gpl-3.0.html GNU GPL
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
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * --------------------------------------------------------------------
 * ZnetDK 4 Mobile Home Menu module Manager class
 *
 * File version: 1.2
 * Last update: 07/29/2025
 */
namespace z4m_homemenu\mod;

/**
 * Provides structured data required to build the home page menu
 */
class HomeMenu {
    private $homeViewName = 'z4m_homemenu';
    private $currentViewName;
    private $columnDefinitionClasses;
    private $displayedMenuItems;
    private $maxPanelsPerRow;
    
    
    public function __construct() {
        $this->displayedMenuItems = [];
        $this->initCurrentViewName();
        $this->initMaxPanelsPerRow();
        $this->initDisplayedMenuItems();
    }

    /**
     * Sets the current home view name to 'z4m_homemenu' or to the view name
     * specified via the MOD_Z4M_HOMEMENU_EXCLUDED_VIEW constant.
     */
    private function initCurrentViewName() {
        $this->currentViewName = MOD_Z4M_HOMEMENU_EXCLUDED_VIEW === NULL
                ? $this->homeViewName : MOD_Z4M_HOMEMENU_EXCLUDED_VIEW;
    }

    /**
     * Sets the maximum panels to display per row from the
     * MOD_Z4M_HOMEMENU_MAX_PANELS_PER_ROW constant.
     * Expected value is 1 to 4 panels per row.
     */
    private function initMaxPanelsPerRow() {
        $this->maxPanelsPerRow = MOD_Z4M_HOMEMENU_MAX_PANELS_PER_ROW;
        // Check configured value for the max number of panels per row
        if ($this->maxPanelsPerRow < 1 || $this->maxPanelsPerRow > 4) {
            General::writeErrorLog($this->currentViewName,
                    "Value '{$this->maxPanelsPerRow}' set for the number of max panels per row is invalid. Expected values are 1 to 4.");
            $this->maxPanelsPerRow = 2;
        }
    }
    
    /**
     * Calculates the level 1 and 2 menu item count.
     * @param array $allMenuItems All menu items defined in the menu.php of the App.
     * @param array $allowedMenus Allowed menu items for the current logged in
     * user.
     * @return array The level 1 menu item count (first value) and an array of
     * level 2 menu item count.
     */
    private function calculateMenuItemCount($allMenuItems, $allowedMenus) {
        $l2MenuCount = [];
        $level1MenuCount = 0;
        foreach ($allMenuItems as $menuDef) { // Level 1 Menu count calculation
            if ($menuDef[0] === $this->currentViewName ||
                    (is_array($allowedMenus) && !in_array($menuDef[0], $allowedMenus))) {
                continue; // Home view is excluded or menu item not allowed
            }
            $level1MenuCount++;
            $l2MenuCount[] = $this->calculateLevel2MenuItemCount($menuDef[2], $allowedMenus);
        }
        return [$level1MenuCount, $l2MenuCount];
    }
    
    /**
     * Calculates de level 2 menu item count.
     * If level 2 menu items exist, the level 2 menu item count is calculated 
     * according to the allowed menu items for the current logged in user.
     * @param array|NULL $level2MenuItems
     * @param array|NULL $allowedMenus
     * @return int The level2 menu item count
     */
    private function calculateLevel2MenuItemCount($level2MenuItems, $allowedMenus) {
        if (!is_array($level2MenuItems)) {
            return 1;
        }
        if (!is_array($allowedMenus)) {
            return count($level2MenuItems);
        }
        $count = 0;
        foreach ($level2MenuItems as $menuDef) {
            if (in_array($menuDef[0], $allowedMenus)) {
                $count++;
            }
        }
        return $count;
    }
    
    /**
     * Sets the responsive column classes applied to the menu panels for large
     * and medium screens.
     * @param int $panelCountPerRow Number of panels per row
     * @return int Number of panels to display on medium screeen
     */
    private function setColumnDefinitionClasses($panelCountPerRow) {
        $colDefCss = [];
        $colCountMedium = [];
        for ($colIdx = 1; $colIdx <= 4; $colIdx++) {
            $colCountMedium[$colIdx] = (($colIdx-1)%2)+1;
            $mCols = 12/$colCountMedium[$colIdx];
            $lCols = 12/$colIdx;
            $colDefCss[$colIdx] = "m{$mCols} l{$lCols}";
        }
        $this->columnDefinitionClasses = $colDefCss[$panelCountPerRow];
        return $colCountMedium[$panelCountPerRow];
    }
    
    /**
     * Generates the home menu rows to display on the home screen.
     * After execution, the '$displayedMenuItems' property contains formatted
     * rows optimzed to be displayed on the App home page.
     * Example of generated rows:
     * [
     *      [ // First row
     *          [ // First panel
     *              'title' => 'First',
     *              'icon' => 'fa-check',
     *              'menuItems' => [
     *                  [ // First menu item
     *                      'title' => 'Subitem 1',
     *                      'icon' => 'fa-plus',
     *                      'viewName' => 'my_view1'
     *                  ], [ // Second menu item
     *                      'title' => 'Subitem 2',
     *                      'icon' => 'fa-minus',
     *                      'viewName' => 'my_view2'
     *                  ]
     *              ]
     *          ], [ // Second panel
     *              ...
     *          }
     *      ],[ // Second row
     *          ...
     *      ]
     * ]
     */
    private function initDisplayedMenuItems() {
        $allMenuItems = [];
        $allowedMenus = \MenuManager::getAllowedMenuItems();
        if ($allowedMenus === FALSE
                || (is_array($allowedMenus) && count($allowedMenus) < 2)) {
            // No menu to display
        } else {
            $allMenuItems = \MenuManager::getMenuItems();
            list($level1MenuCount, $l2MenuCount) = $this->calculateMenuItemCount($allMenuItems, $allowedMenus);
            $colDefApplied = $level1MenuCount > $this->maxPanelsPerRow
                    ? $this->maxPanelsPerRow : $level1MenuCount;
            $colMedium = $this->setColumnDefinitionClasses($colDefApplied);
        }
        $panelNbr = 0;
        $newRowPanels = [];
        foreach ($allMenuItems as $menuDef) {
            if ($menuDef[0] === $this->currentViewName ||
                    (is_array($allowedMenus) && !in_array($menuDef[0], $allowedMenus))) {
                continue; // Home view is excluded or menu item not allowed
            }
            $isNewRow = $panelNbr%$this->maxPanelsPerRow === 0;
            if ($isNewRow && $panelNbr > 0) {
                $this->displayedMenuItems[] = $newRowPanels;
            }
            if ($isNewRow) {
                $newRowPanels = [];
                $maxAnchorsPerLargeRow = max(array_slice($l2MenuCount, $panelNbr, $colDefApplied));
            }
            $newPanel = ['icon' => '', 'menuItems' => []];
            if (is_string($menuDef[3]) && strlen($menuDef[3]) > 0) {
                $newPanel['icon'] = $menuDef[3];
            }
            $newPanel['title'] = $menuDef[1];
            $subItems = is_array($menuDef[2]) ? $menuDef[2] : [$menuDef];
            $notAllowedSubItems = 0;
            foreach ($subItems as $menuItem) {
                if (is_array($allowedMenus) && !in_array($menuItem[0], $allowedMenus)) {
                    $notAllowedSubItems++;
                    continue;
                }
                $newPanel['menuItems'][] = ['viewName' => $menuItem[0],
                    'icon' => $menuItem[3], 'title' => $menuItem[1]
                ];
            }
            $newPanel['largeRowSpacerCount'] = $maxAnchorsPerLargeRow - count($subItems) + $notAllowedSubItems;
            $newPanel['mediumRowSpacerCount'] = 0;
            if ($panelNbr%$colMedium === 0) {
                $maxAnchorsPerMediumRow = max(array_slice($l2MenuCount, $panelNbr, $colMedium));
                $newPanel['mediumRowSpacerCount'] = $maxAnchorsPerMediumRow - count($subItems);
            }
            $newRowPanels[] = $newPanel;
            $panelNbr++;
        }
        $this->displayedMenuItems[] = $newRowPanels;
    }

    /**
     * Returns the effective number of panels per row
     * @return int Number of panels per row
     */
    public function getMenuPanelRows() {
        return $this->displayedMenuItems;
    }
    
    /**
     * Returns the responsive columns CSS classes to apply to panels 
     * @return string The CSS classes, for example 'm2 l4'.
     */
    public function getColumnDefinitionClasses() {
        return $this->columnDefinitionClasses;
    }

    /**
     * Returns the width of the panel icons.
     * @return string For example '128px'.
     */
    public function getPanelIconWidth() {
        return MOD_Z4M_HOMEMENU_PANEL_ICON_WIDTH;
    }

    /**
     * Indicates whether monitoring boxes are to be displayed or not on the home
     * page according to the MOD_Z4M_HOMEMENU_MONITORING_BOXES constant is set
     * or not
     * @return boolean Value TRUE if monitor boxes are to be displyed.
     */
    protected function areMonitoringBoxesToBeShown() {
        return is_array(MOD_Z4M_HOMEMENU_MONITORING_BOXES);
    }
    
    /**
     * Returns the number of monitoring boxes to display for the logged in user.
     * @return int Number of monitoring boxes.
     */
    public function getMonitoringBoxCountToDisplayForLoggedInUser() {
        if (!$this->areMonitoringBoxesToBeShown()) {
            return 0;
        }
        $boxPaths = $this->getMonitoringBoxPaths();
        return count($boxPaths);
    }

    /**
     * Returns the panel count per row including the monitoring panel.
     * @return int Number of panels per row.
     */
    public function getPanelCountPerRow() {
        $countPerRow = $this->getMonitoringBoxCountToDisplayForLoggedInUser() > 0 ? 1 : 0;        
        if (count($this->displayedMenuItems) === 0) {
            return $countPerRow;
        }
        if (count($this->displayedMenuItems) === 1 && count($this->displayedMenuItems[0]) < $this->maxPanelsPerRow) {
            return $countPerRow + count($this->displayedMenuItems[0]);
        }
        return $countPerRow + $this->maxPanelsPerRow;
    }

    /**
     * Returns the paths of the monitoring boxes PHP script to include to the
     * home page according to the definition of the
     * MOD_Z4M_HOMEMENU_MONITORING_BOXES constant.
     * If a user profile is configured for a monitoring box, its path is only
     * returned if this profile is assigned to the logged in user.
     * @return array The paths of the monitoring box PHP scripts.
     */
    public function getMonitoringBoxPaths() {
        if (!$this->areMonitoringBoxesToBeShown()) {
            return [];
        }
        $boxPaths = [];
        $monitoringBoxes = MOD_Z4M_HOMEMENU_MONITORING_BOXES;
        foreach ($monitoringBoxes as $boxDef) {
            if (!key_exists('userProfile', $boxDef) || (is_string($boxDef['userProfile'])
                    && \UserSession::hasUserProfile($boxDef['userProfile']))) {
                $boxPaths[] = $boxDef['boxPath'];
            }
        }
        return $boxPaths;
    }

}