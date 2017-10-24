<?php


return array(
    /** set your paypal credential **/
    'client_id' =>'AZvPYG0CTtAMQ4M96Vg-3HMqMis0QQ6EFoxj6_nwCvebGS15buOEFbPbAv17O8tBT-hrVoDz7_b_EolH',
    'secret' => 'EPkbY6CzbUJLVpj1RegMa6hpaoBX1B8eTv8aoyUx1Wg9d8NWHIK3S8cVqmx0A_ctZxv7s8H5Zn84lCZo',
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