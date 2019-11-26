<?php
/**
 * Created by PhpStorm.
 * User: way2g
 * Date: 17-09-2018
 * Time: 11:34
 */

// Name of Class as mentioned in $hook['post_controller]
defined('BASEPATH') OR exit('No direct script access allowed');
class Db_log {
    function __construct() {
        // Anything except exit() :P
    }
// Name of function same as mentioned in Hooks Config
    function logQueries() {
        $CI = & get_instance();
        $filepath = APPPATH . 'logs/Query-log-' . date('Y-m-d') . '.sql'; // Creating Query Log file with today's date in application/logs folder
        $handle = fopen($filepath, "a+");                 // Opening file with pointer at the end of the file
        $times = $CI->db->query_times;                   // Get execution time of all the queries executed by controller
        $uid=$CI->session->login['userid'];              //Get Login usser id
        $computer= getenv('COMPUTERNAME');
        $hostIP=$_SERVER['REMOTE_ADDR'];
        foreach ($CI->db->queries as $key => $query) {
            $sql = $query . "; \n --Execution Time:" . $times[$key]."\n --Query Executed By:" .$uid ."\n --Computer Name :" .$computer ."-".$hostIP; // Generating SQL file alongwith execution time
            fwrite($handle, $sql . "\n\n");              // Writing it in the log file
        }
        fclose($handle);      // Close the file
    }
}
