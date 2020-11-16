<?php $currentUrl = $this->router->getRewriteUri(); ?>
<ul class="sidebar-menu" data-widget="tree">
    <?php $user = $this->session->get('auth-identity'); ?>
    <?php foreach ($menus as $keyparent => $menu) { ?>
        <?php $menuJson = json_encode($menu); ?>
        <?php $menuActive = false; ?>
        <?php if (isset($activemenu)) { ?>
            <?php foreach ($activemenu as $active) { ?>
                <?php if (($active) === ($keyparent)) { ?>
                    <?php $menuActive = true; ?>
                <?php } ?>
            <?php } ?>
        <?php } ?>
        <?php if (isset($menu->cssClass)) { ?>
            <?php if (isset($menu->role)) { ?>
                <?php $checkheader = 0; ?>
                <?php foreach ($menu->role as $item) { ?>
                    <?php if (($item) === ($user['role'])) { ?>
                        <?php $checkheader = 1; ?>
                        <?php break; ?>
                    <?php } ?>
                <?php } ?>
                <?php if ($checkheader == 1) { ?>
                    <?php if ($menu->cssClass == 'header') { ?>
                        <li class="header"><?= $this->helper->translate($menu->text) ?></li>
                    <?php } ?>
                <?php } ?>
            <?php } else { ?>
                <?php if ($menu->cssClass == 'header') { ?>
                    <li class="header"><?= $this->helper->translate($menu->text) ?></li>
                <?php } ?>
            <?php } ?>
        <?php } else { ?>

            <?php if (isset($menu->role)) { ?>
                <?php $checkmenu = 0; ?>
                <?php foreach ($menu->role as $item) { ?>
                    <?php if (($item) === ($user['role'])) { ?>
                        <?php $checkmenu = 1; ?>
                        <?php break; ?>
                    <?php } ?>
                <?php } ?>
                <?php if ($checkmenu == 1) { ?>
                    <?php if (isset($menu->children)) { ?>
                        <li class="<?= ($menuActive ? 'active ' : '') ?><?= (($this->length($menu->children)) > 0 ? 'treeview' : '') ?><?= ($menuActive ? ' menu-open' : '') ?>">
                            <a href="">
                                <i class="<?= $menu->iconCss ?>"></i>
                                <span><?= $this->helper->translate($menu->text) ?></span>
                                <?php if (($this->length($menu->children)) > 0) { ?>
                                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                                <?php } ?>
                            </a>
                            <?php if (($this->length($menu->children)) > 0) { ?>
                                <ul class="treeview-menu">
                                    <?php foreach ($menu->children as $key => $submenu) { ?>
                                        
                                        <?php $childrenActive = false; ?>
                                        
                                        <?php foreach ($activemenu as $active) { ?>
                                            <?php if (($active) === ($key)) { ?>
                                                <?php $childrenActive = true; ?>
                                            <?php } ?>
                                        <?php } ?>
                                        
                                        <li class="<?= ($childrenActive ? 'active ' : '') ?>">
                                            <a
                                                    href="<?= $submenu->href ?>"><i
                                                        class="<?= $submenu->iconCss ?>"></i><?= $this->helper->translate($submenu->text) ?>
                                            </a></li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                    <?php } else { ?>
                        <li class="<?= ($menuActive ? 'active ' : '') ?>">
                            <a href="<?= $menu->href ?>">
                                <i class="<?= $menu->iconCss ?>"></i>
                                <span><?= $this->helper->translate($menu->text) ?></span>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>
            <?php } else { ?>
                <?php if (isset($menu->children)) { ?>
                    <li class="<?= ($menuActive ? 'active ' : '') ?><?= (($this->length($menu->children)) > 0 ? 'treeview' : '') ?><?= ($menuActive ? ' menu-open' : '') ?>">
                        <a href="">
                            <i class="<?= $menu->iconCss ?>"></i>
                            <span><?= $this->helper->translate($menu->text) ?></span>
                            <?php if (($this->length($menu->children)) > 0) { ?>
                                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                            <?php } ?>
                        </a>
                        <?php if (($this->length($menu->children)) > 0) { ?>
                            <ul class="treeview-menu">
                                <?php foreach ($menu->children as $key => $submenu) { ?>
                                    
                                    <?php $childrenActive = false; ?>
                                    
                                    <?php foreach ($activemenu as $active) { ?>
                                        <?php if (($active) === ($key)) { ?>
                                            <?php $childrenActive = true; ?>
                                        <?php } ?>
                                    <?php } ?>
                                    
                                    <li class="<?= ($childrenActive ? 'active ' : '') ?>">
                                        <a
                                                href="<?= $submenu->href ?>"><i
                                                    class="<?= $submenu->iconCss ?>"></i><?= $this->helper->translate($submenu->text) ?>
                                        </a></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } else { ?>
                    <li class="<?= ($menuActive ? 'active ' : '') ?>">
                        <a href="<?= $menu->href ?>">
                            <i class="<?= $menu->iconCss ?>"></i>
                            <span><?= $this->helper->translate($menu->text) ?></span>
                        </a>
                    </li>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    <?php } ?>
</ul>
