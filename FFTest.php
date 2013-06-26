<?php

/**
 * FFTest
 *
 */

require_once 'PHPUnit/Autoload.php';
require_once 'TestHelper.php';
require_once 'TestConfiguration.php';

class FFTest extends PHPUnit_Framework_TestSuite
{
    public function __construct()
    {
        $dir = dirname(__FILE__);
        //if have the var of the script then run the one file
        if (!empty($_SERVER['argv'][2]) && !empty($_SERVER['argv'][3])) {
            $file = $_SERVER['argv'][2] . DIRECTORY_SEPARATOR . $_SERVER['argv'][3] . '.php';
            if (is_file($file)) {
                $this->addTestFile($file);
            } else {
                echo "$file FILE NOT FIND ,PLEASE CHECK \n";
            }
        } else if (!empty($_SERVER['argv'][2]) && $_SERVER['argv'][2] != 'all') {
            $path = $dir . DIRECTORY_SEPARATOR . $_SERVER['argv'][2];
            if (is_dir($path)) {
                $fileArr = files($path);
                if (!empty($fileArr)) {
                    foreach ($fileArr as $f) {
                        $f = $path . DIRECTORY_SEPARATOR . $f;
                        $this->addTestFile($f);
                    }
                }
            } else {
                echo "$path is not a dir or the dir is empty!";
            }
        } else if (!empty($_SERVER['argv'][2]) && $_SERVER['argv'][2] == 'all') {
            $packages = require_once 'TestPackage.php';
            $testFiles = array();
            foreach ($packages as $val) {
                $path = $dir . DIRECTORY_SEPARATOR . $val;
                if (is_dir($path)) {
                    $fileArr = files($path);
                    foreach ($fileArr as &$one) {
                        $one = $path . DIRECTORY_SEPARATOR . $one;
                    }
                    $testFiles = array_merge($testFiles, $fileArr);
                }
            }

            if (!empty($testFiles)) {
                foreach ($testFiles as $f) {
                    $this->addTestFile($f);
                }
            }
        } else {
            echo "******************FFTestSuite Useage:*************************\nphpunit FFTest.php all ,test all of testcases.\nphpunit FFTest.php foldername , test testcase behind the folder.\nphpunit FFTest.php foldername filename , run test the one .\n";
        }
        echo "ALL TEST CASE RUN COMPLETE！ ^_^ \n\n\n";
    }

    public static function suite()
    {
        return new self();
    }
}
