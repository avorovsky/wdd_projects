<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * model to link Book to Course
 */

namespace Models;

class BookForCourse
{
    /*
     * adds connection between items
     * 
     * @param int - id of the first item to connest
     * @param int - id of the second item to connect
     * @return boolean - success
     */
    public static function addConnection($book_id, $course_id)
    {
        $book_id   = intval($book_id);
        $course_id = intval($course_id);

        if ($book_id && $course_id) {
            // query
            $queryString = 'INSERT INTO `book_for_course` '.
                '(book_id, course_id) VALUES ('.
                ':book_id, :course_id)';
            $paramsArray = array(
                ':book_id' => $book_id,
                ':course_id' => $course_id,
            );

            $result = \Components\DbQuery::getResult($queryString, $paramsArray,
                    1);
        }

        return true;
    }

    /*
     * delets connection between items
     *
     * @param int - id of the first item to unconnest
     * @param int - id of the second item to unconnect
     * @return boolean - success
     */
    public static function delConnection($book_id, $course_id)
    {
        $book_id   = intval($book_id);
        $course_id = intval($course_id);

        if ($book_id && $course_id) {
            // query
            $queryString = 'DELETE FROM `book_for_course` '.
                'WHERE book_id = :book_id '.
                'AND course_id = :course_id';
            $paramsArray = array(
                ':book_id' => $book_id,
                ':course_id' => $course_id,
            );

            $result = \Components\DbQuery::getResult($queryString, $paramsArray,
                    1);
        }

        return true;
    }

    /*
     * returns list of connected items
     * 
     *@param int - id of item asked for
     *@return array - list of items related
     */
    public static function getBookForCourse($id)
    {
        $id = intval($id);

        if ($id) {
            // query
            $queryString = 'SELECT '.
                'book_for_course.book_id AS book_id, '.
                'book_for_course.course_id AS course_id, '.
                'book.id, book.deleted, book.name, book.author, '.
                'book.price, book.image, book.image_mime '.
                'FROM `book_for_course` '.
                'JOIN `book` ON book.id = book_id '.
                'WHERE book_for_course.course_id = :id '.
                'ORDER BY name ASC';
            $paramsArray = array(
                ':id' => $id,
            );

            $result = \Components\DbQuery::getResult($queryString, $paramsArray);

            return $result;
        }

        return [];
    }

    /*
     * returns list of connected items
     *
     *@param int - id of item asked for
     *@return array - list of items related
     */
    public static function getCourseForBook($id)
    {
        $id = intval($id);

        if ($id) {
            // query
            $queryString = 'SELECT '.
                'book_for_course.book_id AS book_id, '.
                'book_for_course.course_id AS course_id, '.
                'course.id, course.deleted, '.
                'course.name AS name '.
                'FROM `book_for_course` '.
                'JOIN `course` ON course.id = course_id '.
                'WHERE book_for_course.book_id = :id '.
                'ORDER BY name ASC';
            $paramsArray = array(
                ':id' => $id,
            );

            $result = \Components\DbQuery::getResult($queryString, $paramsArray);

            return $result;
        }

        return [];
    }

    /*
     * returns list of not connected items
     *
     *@param int - id of item asked for
     *@return array - list of items not related yet
     */
    public static function getCourseList($id)
    {
        $id = intval($id);

        if ($id) {
            // query for associated courses
            $coursesAssociated = 'SELECT course_id '.
                'FROM `book_for_course` '.
                'WHERE book_for_course.book_id = :id';
            $paramsArray       = array(
                ':id' => $id,
            );

            // query for courses noy yet associated
            $queryString = 'SELECT id, name, deleted '.
                'FROM `course` '.
                'WHERE id NOT IN ('.$coursesAssociated.') '.
                'ORDER BY name ASC';

            $result = \Components\DbQuery::getResult($queryString, $paramsArray);

            return $result;
        }

        return [];
    }
}