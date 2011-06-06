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
 * @subpackage    cake.cake.libs.view.templates.elements.email.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<p>Dear <?=$user["first_name"]." ".$user["last_name"];?></p>
<p>This is your new password <b><?=$user["password"];?></b></p>
<p>Please login <?=$this->Html->link($this->Html->url("/users/login"), "/users/login");?></p>
<hr />
<p>If you have any questions, please don't hesitate to contact us at budgetcustomercare@trihoprojects.com</p>