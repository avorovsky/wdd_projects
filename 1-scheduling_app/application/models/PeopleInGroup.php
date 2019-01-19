<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * model to link People to Group
 */

namespace Models;

class PeopleInGroup
{
    
    /*
     * adds connection between items
     *
     * @param int - id of the first item to connest
     * @param int - id of the second item to connect
     * @return boolean - success
     */
    public static function addConnection($people_id, $group_id)
    {
        $people_id = intval($people_id);
        $group_id = intval($group_id);

        if ($people_id && $group_id) {
            // query
            $queryString = 'INSERT INTO `people_in_group` '.
                           '(people_id, group_id) VALUES ('.
                           ':people_id, :group_id)';
            $paramsArray = array(
                           ':people_id' => $people_id,
                           ':group_id' => $group_id,
                           );

            $result = \Components\DbQuery::getResult($queryString, $paramsArray, 1);
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
    public static function delConnection($people_id, $group_id)
    {
        $people_id = intval($people_id);
        $group_id = intval($group_id);

        if ($people_id && $group_id) {
            // query
            $queryString = 'DELETE FROM `people_in_group` '.
                           'WHERE people_id = :people_id '.
                           'AND group_id = :group_id';
            $paramsArray = array(
                           ':people_id' => $people_id,
                           ':group_id' => $group_id,
                           );

            $result = \Components\DbQuery::getResult($queryString, $paramsArray, 1);
        }

        return true;
        
    }
    
    /*
     * returns list of connected items
     *
     *@param int - id of item asked for
     *@return array - list of items related
     */
    public static function getGroupList($id)
    {
        $id = intval($id);

        if ($id) {
            // query for associated groups
            $memberOfGroups = 'SELECT group_id '.
                              'FROM `people_in_group` '.
                              'WHERE people_in_group.people_id = :id';
            $paramsArray = array(
                              ':id' => $id,
                              );
            
            // query for available yet groups
            $queryString = 'SELECT group.id, group.name, group.course_id, group.deleted, '.
                           'course.name AS course_name '.
                           'FROM `group` '.
                           'JOIN `course` ON group.course_id = course.id '.
                           'WHERE group.id NOT IN ('.$memberOfGroups.') '.
                           'ORDER BY name ASC';

            $result = \Components\DbQuery::getResult($queryString, $paramsArray);

            return $result;
            
        }
        
        return [];
        
    }
    
    /*
     * returns list of not connected items
     *
     *@param int - id of item asked for
     *@param string - role of person (optional)
     *@return array - list of items not related yet
     */
    public static function getPeopleList($id, $role='')
    {
        $id = intval($id);
        
        if ($id) {
            // query for associated people
            $membersOfGroup = 'SELECT people_id '.
                              'FROM `people_in_group` '.
                              'WHERE people_in_group.group_id = :id';
            $paramsArray = array(
                              ':id' => $id,
                              );
            
            // query for peole noy yet in group
            $queryString = 'SELECT id, first_name, last_name, phone, email, deleted '.
                           'FROM `people` '.
                           'WHERE id NOT IN ('.$membersOfGroup.') '.
                           ($role == 's' ? 'AND people.is_student = 1 ' : '').
                           ($role == 'i' ? 'AND people.is_instructor = 1 ' : '').
                           'AND people.not_verified<>1 '.
                           'ORDER BY last_name ASC';

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
    public static function getGroupsOfPeople($id)
    {
        $id = intval($id);

        if ($id) {
            // query
            $queryString = 'SELECT '.
                           'people_in_group.group_id AS group_id, '.
                           'people_in_group.people_id AS people_id, '.
                           'group.id, group.deleted, '.
                           'group.name AS name, '.
                           'course.name AS course_name '.
                           'FROM `people_in_group` '.
                           'JOIN `group` ON people_in_group.group_id = group.id '.
                           'JOIN `course` ON group.course_id = course.id '.
                           'WHERE people_in_group.people_id = :id '.
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
    public static function getPeopleOfGroup($id)
    {
        $id = intval($id);
        
        if ($id) {
            // query
            $queryString = 'SELECT '.
                           'people_in_group.group_id AS group_id, '.
                           'people_in_group.people_id AS people_id, '.
                           'people.id, '.
                           'people.first_name AS first_name, '.
                           'people.last_name AS last_name, '.
                           'people.phone AS phone, '.
                           'people.email AS email, '.
                           'people.deleted AS deleted '.
                           'FROM `people_in_group` '.
                           'JOIN `people` ON people.id = people_in_group.people_id '.
                           'WHERE people_in_group.group_id = :id '.
                           'ORDER BY last_name ASC';
            $paramsArray = array(
                           ':id' => $id,
                           );

            $result = \Components\DbQuery::getResult($queryString, $paramsArray);

            return $result;
            
        }
         
        return [];
        
   }
}
