<?php

        

        // disable default disconnect checks
        ignore_user_abort(true);

        // set headers for stream
        header("Content-Type: text/event-stream");
        header("Cache-Control: no-cache");
        header("Access-Control-Allow-Origin: *");

		$currentTime = date("H:i:s", time());

        // Is this a new stream or an existing one?
        $lastEventId = floatval(isset($_SERVER["HTTP_LAST_EVENT_ID"]) ? $_SERVER["HTTP_LAST_EVENT_ID"] : 0);
        if ($lastEventId == 0) {
            $lastEventId = floatval(isset($_GET["lastEventId"]) ? $_GET["lastEventId"] : 0);
        }

        
        // start stream
        while(true){
            if(connection_aborted()){
                exit();
            } else{

                // here you will want to get the latest event id you have created on the server, but for now we will increment and force an update
                $latestEventId = $lastEventId+1;

                if($lastEventId < $latestEventId){
                    echo "id: " . $latestEventId . "\n";
                    echo "data: Howdy (".$latestEventId.") \n\n";
                    $lastEventId = $latestEventId;
                    ob_flush();
                    flush();
                } else{
                    // no new data to send
                    echo ": heartbeat\n\n";
                    ob_flush();
                    flush();
                }
            }
    
            // 2 second sleep then carry on
            sleep(2);
        }