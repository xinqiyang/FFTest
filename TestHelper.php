<?php

function files($path,&$files = array())
{
    $dir = opendir($path."/.");
    while($item = readdir($dir))
        if(is_file($sub = $path."/".$item))
            $files[] = $item;else
            if($item != "." and $item != "..")
                files($sub,$files); 
    return($files);
}



function testRun($file) {
    echo "RUN TEST START： $file \n";
    echo "----------------------------------------------------------------------------\n";
    echo shell_exec("phpunit --colors $file");
    echo "----------------------------------------------------------------------------\n";
}