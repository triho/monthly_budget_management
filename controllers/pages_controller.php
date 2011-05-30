<?php

/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 */
class PagesController extends AppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    var $name = 'Pages';
    /**
     * Default helper
     *
     * @var array
     * @access public
     */
    var $helpers = array('Html', "Number");
    /**
     * This controller does not use a model
     *
     * @var array
     * @access public
     */
    var $uses = array("Expense", "Budget");

    /**
     * Displays a view
     *
     * @param mixed What page to display
     * @access public
     */
    function display() {
        $path = func_get_args();

        $count = count($path);
        if (!$count) {
            $this->redirect('/');
        }
        $page = $subpage = $title_for_layout = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        if (!empty($path[$count - 1])) {
            $title_for_layout = Inflector::humanize($path[$count - 1]);
        }

        $budget = $this->Budget->find("first", array(
                    "conditions" => array(
                        "MONTH(Budget.period_date)" => date("n"),
                        "YEAR(Budget.period_date)" => date("Y")
                    )
                ));

        if (isset($budget) && !empty($budget)) {
            $expenses = $this->Expense->find("all", array(
//                        "conditions" => array("MONTH(Expense.expense_date)" => date("n")),
                        "conditions" => array("Expense.budget_id" => $budget["Budget"]["id"]),
                        "recursive" => 1,
                        "order" => array("Expense.expense_date DESC")
                    ));
            // Calculate expenses
            $sum = 0;
            if (!empty($expenses)) {
                foreach ($expenses as $expense) {
                    $sum += $expense["Expense"]["amount"];
                }
            }
            $this->set("totalSpendingOfThisMonth", $sum);
        } else {
            $expenses = array();
            $budget = array();
        }

        $this->set("budget", $budget);
        $this->set("expenses", $expenses);
        $this->set(compact('page', 'subpage', 'title_for_layout'));
        $this->render(implode('/', $path));
    }

}
