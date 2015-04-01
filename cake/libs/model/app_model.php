<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @subpackage    cake.cake.libs.model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application model for Cake.
 *
 * This is a placeholder class.
 * Create the same file in app/app_model.php
 * Add your application-wide methods to the class, your models will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.model
 */
class AppModel extends Model {
	/**
     * 画像のMIME型のチェック
     *
     * @param array $data
     * @param array $exts
     * @return boolean
     */
    function imageMime($data, $exts) {
        if ($data['image_name']['error'] == 0) {
            foreach ($exts as $ext) {
                if (strpos($data['image_name']['type'], $ext) !== false) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * ファイルの有無のチェック
     *
     * @param array $data
     * @return boolean
     */
    function existsFile($data) {
        if ($data['image_name']['error'] == 0 && $data['image_name']['size'] != 0) {
            return true;
        }
        return false;
    }

    /**
     * ファイルサイズのチェック
     *
     * @param array $data
     * @param int $fileSize
     * @return boolean
     */
    function maxFileSize($data, $fileSize) {
        if ($data['image_name']['error'] == 0 && $data['image_name']['size'] < $fileSize) {
            return true;
        }
        return false;
    }
}