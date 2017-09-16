<?php 


return array(
/** set your paypal credential **/
'client_id' =>'Af_CXYeYgtHmtSe14aO4RbsOu-c7l-aMS5sjAIxUHjasJww_nPVSfovKoGxg9Y0EU8Dqu4r38cSMH-f-',
'secret' => 'EBqyTTvrtRJGj5rO2R82h3o1fZGQM75x4pxprq70KBTn0DJEDSVUTbG8LF5rP9rwO1CVvfPN0Zvwkx82',
/**
* SDK configuration 
*/
'settings' => array(
/**
* Available option 'sandbox' or 'live'
*/
'mode' => 'sandbox',
/**
* Specify the max request time in seconds
*/
'http.ConnectionTimeOut' => 1000,
/**
* Whether want to log to a file
*/
'log.LogEnabled' => true,
/**
* Specify the file that want to write on
*/
'log.FileName' => storage_path() . '/logs/paypal.log',
/**
* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
*
* Logging is most verbose in the 'FINE' level and decreases as you
* proceed towards ERROR
*/
'log.LogLevel' => 'FINE'
),
);