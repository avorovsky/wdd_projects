<?php

/* 
 * Image model
 */

namespace Models;

class Image
{

    /**
     * returns path to item by column value
     * @param  string $column
     * @param  string $value
     * @return string
     */
    public static function getByColumn($column, $value)
    {

        if (empty($value)) {
            return [];
        }

        $queryString =
            'SELECT * from `images` ' .
            'WHERE `' . $column . '` = :' . $column . ' ' .
            'ORDER BY created_at DESC ';
            'LIMIT 1';
        $paramsArray = array(
            $column => $value,
        );

        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString, $paramsArray);

        // check for empty result
        $result = (empty($result) ? ['image' => IMGPH] : $result[0]);

        // check if image defined in database
        $image = (!empty($result) ? IMG.'products'.DS.$result['image'] : IMGPH);


        // check if image file exists
        $image = (file_exists($_SERVER['DOCUMENT_ROOT'].$image) ? $image : IMGPH);

        return $image;

    }

    /**
     * returns array of pathes to item by column value
     * @param  string $column
     * @param  string $value
     * @return string
     */
    public static function getListByColumn($column, $value)
    {

        if (empty($value)) {
            return [];
        }

        $queryString =
            'SELECT * from `images` ' .
            'WHERE `' . $column . '` = :' . $column . ' ' .
            'ORDER BY created_at DESC';
        $paramsArray = array(
            $column => $value,
        );

        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString, $paramsArray);
    
        // check for empty result
        $result = (empty($result) ? [ '0' => ['image' => IMGPH]] : $result);

        foreach ($result as $key => $value) {

            // check if image defined in database
            $result[$key]['image'] = (!empty($value['image']) ? IMG.'products'.DS.$value['image'] : IMGPH);

            // check if image file exists
            $result[$key]['image'] = (file_exists($_SERVER['DOCUMENT_ROOT'].$result[$key]['image']) ? $result[$key]['image'] : IMGPH);

            /* src="<?=(file_exists($_SERVER['DOCUMENT_ROOT'].IMG.'products'.DS.$image['image']) ? $image['image'] : IMGPH)?>" */
        
        }

        return $result;

    }

    /**
     * checks and updatel list of images
     * @param  integer $id
     * @return boolean
     */
    public static function updateList($id)
    {

        // code is not optimal for easy reading

        $id = intval($id);

        // if nothing passed, there's nothing to do
        if (empty($_SESSION['product_images']) OR empty($id)) {
            return true;
        }

        $data = $_SESSION['product_images'];
        unset($_SESSION['product_images']);

        foreach ($data as $key => $value) {

            // check if item exists
            $queryString =
                'SELECT * from `images` ' .
                'WHERE (product_id=:product_id '.
                'AND image=:image)';
            $paramsArray = array(
                ':product_id' => $id,
                ':image' => $value['image'],
            );

            $dbh = new \Components\Db();
            $result = $dbh->getResult($queryString, $paramsArray);

            if (empty($result) AND empty($value['deleted'])) {

                // does not exist, let's add
                $queryString =
                        'INSERT INTO `images` ('.
                        'product_id, '.
                        'image) '.
                        'VALUES ('.
                        ':product_id, '.
                        ':image)';
                $paramsArray = array(
                        ':product_id' => $id,
                        ':image' => $value['image'],
                        );
            
                $dbh = new \Components\Db();
                $result = $dbh->getResult($queryString, $paramsArray, 1);

            } elseif (!empty($result) AND !empty($value['deleted'])) {

                // exists, must be deleted
                $queryString =
                    'DELETE FROM `images` '.
                    'WHERE (product_id=:product_id '.
                    'AND image=:image)';
                $paramsArray = array(
                    ':product_id' => $id,
                    ':image' => $value['image'],
                );
            
                $dbh = new \Components\Db();
                $result = $dbh->getResult($queryString, $paramsArray, 0, 1);
                
            } else {

                // exists, not deleted, do nothing for now

            }

        }

        return true;

    }

}

