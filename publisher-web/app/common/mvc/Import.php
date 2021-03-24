<?php

/**
 * Meta
 */

namespace Publisher\Common\Mvc;

use PHPExcel_IOFactory;
use PHPExcel_Cell;

class Import extends \Phalcon\Mvc\User\Component {

    private static $instance;
    private static $file;
    private static $model;
    private static $fixData;

    public static function getInstance($file, $model, $fixData) {
        if (!self::$instance) {
            self::$instance = new Import();
        }
        self::$instance->setFile($file);
        self::$instance->setModel($model);
        self::$instance->setFixData($fixData);
        return self::$instance;
    }

    static function getFile() {
        return self::$file;
    }

    static function getModel() {
        return self::$model;
    }

    static function setFile($file) {
        self::$file = $file;
    }

    static function setModel($model) {
        self::$model = $model;
    }

    static function getFixData() {
        return self::$fixData;
    }

    static function setFixData($fixData) {
        self::$fixData = $fixData;
    }

    public static function convertVItoEN($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace('/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/', 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = preg_replace("/(\s)/", '', $str);
        return $str;
    }

    public static function getData() {
        $import = include_once BASE_PATH . '/data/excel-tpl/import.php';
        $arr = $import[self::$model];
        $dataError = [];


        $data = PHPExcel_IOFactory::load(self::$file);
        $sheetname = $data->getSheetNames();
        for ($imm = 0; $imm < $data->getSheetCount(); ++$imm) {
            $highestColumm = $data->setActiveSheetIndex($imm)->getHighestDataColumn();
            $sheetData = $data->getActiveSheet()->toArray(null, true, true, true);
            //Transcript
            $listData = [];
            $currentRow = 0;
            foreach ($sheetData as $row) {
                if($currentRow <4){
                    $currentRow++;
                    continue;
                }
                $item = [];
                foreach ($arr['columns'] as $colum) {
                    $item[$colum['field']] = trim($row[$colum['char']]);
                }
                $listData[] = $item;
                $currentRow++;
            }
            if (count($listData)) {
                $data_import =  $listData;
            } else {
                $data_import = "";
            }
        }
        return $data_import;
    }

    public static function getDataBill() {
        $import = include_once BASE_PATH . '/data/excel-tpl/importbill.php';
        $arr = $import[self::$model];
        $dataError = [];


        $data = PHPExcel_IOFactory::load(self::$file);
        $sheetname = $data->getSheetNames();
        for ($imm = 0; $imm < $data->getSheetCount(); ++$imm) {
            $highestColumm = $data->setActiveSheetIndex($imm)->getHighestDataColumn();
            $sheetData = $data->getActiveSheet()->toArray(null, true, true, true);
            //Transcript
            $listData = [];
            $currentRow = 0;
            foreach ($sheetData as $row) {
                if($currentRow <4){
                    $currentRow++;
                    continue;
                }
                $item = [];
                foreach ($arr['columns'] as $colum) {
                    $item[$colum['field']] = trim($row[$colum['char']]);
                }
                $listData[] = $item;
                $currentRow++;
            }
            if (count($listData)) {
                $data_import =  $listData;
            } else {
                $data_import = "";
            }
        }
        return $data_import;
    }


}
