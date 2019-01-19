<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * few simple operations with dates
 */

namespace Components;

class Dater
{
    /*
     * returns formatted date of week's start
     * @return string
     */
    public function getWeekStart()
    {
        // number of weekday (0-sunday, 6-saturday)
        $today = date('w');
        
        return date('Y-m-d', strtotime('-'.$today.' days'));
    }

    /*
     * returns formatted date of week's end
     * @return string
     */
    public function getWeekEnd()
    {
        // number of weekday (0-sunday, 6-saturday)
        $today = date('w');
        
        return date('Y-m-d', strtotime('+'.(6-$today).' days'));        
    }

    /*
     * returns formatted date of month's start
     * @return string
     */
    public function getMonthStart()
    {
        return date('Y-m-').'01';
    }
    
    /*
     * returns formatted date of month's end
     * @return string
     */
    public function getMonthEnd()
    {
        // t - Number of days in the given month (28 through 31)
        return date('Y-m-t');        
    }
    
    /*
     * returns formatted date of today
     * @return string
     */
    public function getToday()
    {
        return date('Y-m-d');
    }
}
