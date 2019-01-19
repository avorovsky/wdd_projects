<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * retrives some statictics on DB
 */

namespace Models;

class Dbinfo
{

    /*
     * returns list of database's tables
     *
     * @return array - list of tables
     */
    private static function getListTables()
    {
        // query
        $queryString = 'SHOW TABLES';
        $result = \Components\DbQuery::getResult($queryString);

        return ($result);

    }

    /*
     * returns number of resords in table
     *
     * @param string - table name
     * @return int - number of records
     */
    private static function getNumberRecords($table)
    {
        // query
        $queryString = 'SELECT COUNT(*) AS record_count FROM `'.$table.'`';
        $result = \Components\DbQuery::getResult($queryString);

        return ($result[0]['record_count']);

    }

    /*
     * returns number and amout of sales
     *
     * @return array - number/amount of sales done
     */
    private static function getSales()
    {
        // query
        $queryString = 'SELECT * FROM `order`';
        $result = \Components\DbQuery::getResult($queryString);

        $sales_total = 0;
        $sales_count = 0;
        foreach ($result as $value) {
            $order = json_decode($value['cart']);
            $sales_total += $order->subtotal;
            $sales_count += $order->count;
        }

        return array (
            'books_sold_number' => $sales_count,
            'books_sold_amount' => '$'.$sales_total,
            );

    }

    /*
     * returns min/max/avg price of items
     *
     * @return array - min/max/avg price of items
     */
    private static function getBookPrices()
    {
        // query
        $queryString = 'SELECT '.
                       'MAX(price) AS price_maximum, '.
                       'MIN(price) AS price_minimum, '.
                       'AVG(price) AS price_average '.
                       'FROM `book`';
        $result = \Components\DbQuery::getResult($queryString);

        return array (
            'book_price_maximum' => '$'.$result[0]['price_maximum'],
            'book_price_minimum' => '$'.$result[0]['price_minimum'],
            'book_price_average' => '$'.$result[0]['price_average'],
            );

    }

    /* gets aggregate data from database
     *
     * @return array - names/values od data requested
     */
    public static function getData()
    {

        $result = array();

        // list of database's tables
        $tables = self::getListTables();

        // get name of DB
        $params = include(APP.'config/dbConfig.php');
        $result['database_name'] = $params['dbname'];

        // number of record for tables
        foreach ($tables as $value) {
            $result['records_total_table_'.$value['Tables_in_'.$result['database_name']]] = self::getNumberRecords($value['Tables_in_'.$result['database_name']]);
        }

        // max/min book prices
        $result = array_merge($result, self::getBookPrices());

        // sales total
        $result = array_merge($result, self::getSales());

        return $result;

    }

}