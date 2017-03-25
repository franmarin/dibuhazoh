<?php

namespace Dibuhazoh;

use Dibuhazoh\Config;
use \Exception;

class DibuhazohProvider {
    private static $dibuhazoh;
    private static $totalDibuhazoh;

    public static function getDibuhazohAsJson($filters) {
        static::_load($filters);
        $output = array(
            'total' => static::$totalDibuhazoh,
            'dibuhazoh' => static::$dibuhazoh
        );
        return json_encode($output);
    }

    private static function _load($filters) {
        static::_areValidFilters($filters);
        $data = @file_get_contents(Config::DATA_FILE_PATH);
        if (!$data) {
            throw new Exception('Error loading data.');
        }
        $explodedData = explode(PHP_EOL, $data);
        $headers = str_getcsv(array_shift($explodedData));
        static::$totalDibuhazoh = count($explodedData);
        static::_loadFiltering($headers, $explodedData, $filters);
    }

    private static function _areValidFilters($filters) {
        if (empty($filters)) {
            throw new Exception('No filters specified.');
        } else if (!isset($filters[Config::FIELD_FROM])) {
            throw new Exception('"From" filter must be specified.');
        }
        $from = $filters[Config::FIELD_FROM];
        if ($from < 0) {
            throw new Exception('Index must be > 0.');
        }
    }

    private static function _loadFiltering($headers, $data, $filters) {
        static::$dibuhazoh = array();
        $indexFirstValidRow = $filters[Config::FIELD_FROM];
        $maxValidRows = $indexFirstValidRow + Config::MAX_BATCH_ITEMS;
        $validRowCounter = 0;
        foreach ($data as $line) {
            if ($validRowCounter >= $maxValidRows) {
                return;
            }
            $line = str_getcsv($line);
            $indexedData = array_combine($headers, $line);
            if (static::_isValidRow($indexedData, $filters)) {
                if ($validRowCounter >= $indexFirstValidRow) {
                    static::$dibuhazoh[] = $indexedData;
                }
                $validRowCounter++;
            }
        }
    }

    private static function _isValidRow($data, $filters) {
        return static::_isValidByDownloadedAndImage($data, $filters) && 
                static::_isValidByTypeAndFormatAndProducer($data, $filters) &&
                static::_isValidByYear($data[Config::FIELD_YEAR], $filters);
    }

    private static function _isValidByDownloadedAndImage($fieldValues, $filters) {
        $indexes = array(Config::FIELD_DOWNLOADED, Config::FIELD_IMAGE);
        $valid = TRUE;
        foreach($indexes as $index) {
            $fieldValue = $fieldValues[$index];
            $valid = $valid && (!isset($filters[$index]) || $filters[$index] == !empty($fieldValue));
        }
        return $valid;
    }

    private static function _isValidByTypeAndFormatAndProducer($fieldValues, $filters) {
        $indexes = array(Config::FIELD_TYPE, Config::FIELD_FORMAT, Config::FIELD_PRODUCER);
        $valid = TRUE;
        foreach($indexes as $index) {
            $fieldValue = $fieldValues[$index];
            $valid = $valid && (!isset($filters[$index]) || $filters[$index] == $fieldValue);
        }
        return $valid;
    }

    private static function _isValidByYear($year, $filters) {
        if (!isset($filters[Config::FIELD_YEAR])) {
            return TRUE;
        }
        if (strpos($filters[Config::FIELD_YEAR], '-') !== FALSE) {
            $years = explode('-', $filters[Config::FIELD_YEAR]);
            if ($year >= $years[0] && $year <= $years[1]) {
                return TRUE;
            }
        } else if (strpos($filters[Config::FIELD_YEAR], '<') !== FALSE) {
            $x = str_replace('<', '', $filters[Config::FIELD_YEAR]);
            if ($year < $x) {
                return TRUE;
            }
        } else if (strpos($filters[Config::FIELD_YEAR], '>') !== FALSE) {
            $x = str_replace('>', '', $filters[Config::FIELD_YEAR]);
            if ($year > $x) {
                return TRUE;
            }
        }
        return FALSE;
    }

}
