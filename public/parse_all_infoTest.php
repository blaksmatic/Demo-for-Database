<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 3/10/16
 * Time: 4:17 AM
 */
class parse_all_infoTest extends PHPUnit_Framework_TestCase
{

    public function __construct()
    {
        $parse = new parse_all_info();
        $parse->get_assignment("Assignment");
        assert(count($parse->get_assignment("sese")) == 0);
        assert(count($parse->get_assignment_with_exact_name("Assignment1.0")) == 1);
    }

}
