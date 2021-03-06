<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.skel.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->css(array('cake.generic', "grid", "smoothness/jquery-ui-1.8.13.custom", "default"));
        echo $javascript->link(array("jquery-1.5.1.min", "jquery-ui-1.8.13.custom.min", "default"));
        echo $scripts_for_layout;
        ?>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <div id="panel">
                    <?= $this->Html->link("Log out", "/users/logout", array("id" => "logout")); ?>
                    <?=$this->Html->link("Home", "/", array("id"=>"home"))?>
                    <?=$this->Html->link("Add new expense", "/expenses/add", array("id"=>"new-expense"));?>
                    <?=$this->Html->link("View all expenses", "/expenses/", array("id"=>"view-expenses"))?>
                    <?=$this->Html->link("Manage my groups", "/groups/", array("id"=>"manage-groups"));?>
                    <?=$this->Html->link("Edit profile", "/users/edit", array("id"=>"profile"));?>
                </div>
            </div>
            <div id="content">

                <?php echo $this->Session->flash(); ?>

                <?php echo $content_for_layout; ?>

            </div>
            <div id="footer">
            </div>
        </div>
        <?php echo $this->element('sql_dump'); ?>
    </body>
</html>