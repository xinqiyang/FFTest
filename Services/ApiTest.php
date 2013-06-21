<?php

require_once dirname(dirname(__FILE__))."/TestConfiguration.php";

class ApiTest extends PHPUnit_Framework_TestCase {
	
	public function testService()
	{
        //use curl to get a function
        $url = "http://app.test.com/hello?name=".time();
        $bool = false;
        $ret = Curl::get($url);
        if($ret) {
            $bool = true;
            var_dump($ret);
        }

		$this->assertEquals(true,$bool);
		
	}	
}
