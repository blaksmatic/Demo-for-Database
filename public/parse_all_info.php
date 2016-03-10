<?php

include "./php_lib/assignment_entry.php";
include "./php_lib/log_entry.php";

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 3/8/16
 * Time: 11:34 PM
 */
class parse_all_info
{

    public $parse_info;
    public $svn_list_info_json; //the file storing the JSON format
    public $svn_log_info_json; //the file storing the JSON format
    public $svn_list_info; //the file containing all the info. not in JSON.
    public $svn_log_info; //the file containting all the info. not in JSON.

    /**
     * parse_all_info constructor. read the file and parse all the information.
     * @param $svn_log : the path of the svn_list file
     * @param $svn_list : the path of the svn_log file
     */
    public function __construct()
    {
        //Read and parse the elements into Json.
        $svn_log_info = simplexml_load_file("./data/svn_log.xml");
        $json = json_encode($svn_log_info);
        $this->svn_log_info_json = json_decode($json, TRUE);

        $svn_list_info = simplexml_load_file("./data/svn_list.xml");
        $json = json_encode($svn_list_info);
        $this->svn_list_info_json = json_decode($json, TRUE);

        $this->pre_processing();
    }

    /**
     * This function pre_processing all attributes of the array and make them look the
     * same as the one in java. (I am really not good at php.) Now every assignment will have
     * its history submit. Note that only exited assignments will have its history. Deleted assignments
     * will not have any history.
     */
    public function pre_processing()
    {

        $this->svn_list_info = array();
        $this->svn_log_info = array();
        $all_names_array = array(); // an array contains all the names of the attributes. so that we can select logs
        //print_r($this->svn_list_info_json["list"]);
        foreach ($this->svn_list_info_json["list"]["entry"] as $each_entry) {

            //add the size. some does not have a size
            if (array_key_exists("size", $each_entry))
                $temp_size = $each_entry["size"];
            else
                $temp_size = 0;

            $new_assignment = new assignment_entry($each_entry["name"], $each_entry["@attributes"]["kind"], $each_entry["commit"]["@attributes"]["revision"], $each_entry["commit"]["date"], $temp_size);
            $author_name = "/yzeng19/";
            $all_names_array[] = $author_name . $each_entry["name"];
            $this->svn_list_info[$each_entry["name"]] = $new_assignment;
        }
        // foreach ($all_names_array as $temp)
        //    echo ($temp);
        //print_r($all_names_array);
        //print_r($this->svn_log_info_json["logentry"]);
        foreach ($this->svn_log_info_json["logentry"] as $each_entry) {
            $temp_message = $each_entry["msg"];

            //TODO: should fix the representation of time
            //TODO: should generate different file type depending on the name
            $temp_date = $each_entry["date"];
            $temp_revision = $each_entry["@attributes"]["revision"];
            $each_entry_paths = $each_entry["paths"];
            $each_entry_paths = $each_entry_paths["path"];
            //print_r($each_entry_paths);
            //This line has to be added because some of them are not even objects. Caused by SVN
            if (is_array($each_entry_paths) || is_object($each_entry_paths)) {
                foreach ($each_entry_paths as $each_path) {
                    //delete all white spaces in the string, and compare them
                    $each_path = preg_replace('/\s+/', '', $each_path);
                    //echo($each_path);
                    if (in_array($each_path, $all_names_array, false)) {
                        $new_log_entry = new log_entry($temp_message, $temp_date, $temp_revision);
                        $file_name = str_replace("/yzeng19/", "", $each_path);
                        $this->svn_list_info[$file_name]->add_log_entry($new_log_entry, $temp_revision);
                    }

                }
            }
        }
    }


    //TODO: add function to decrease the overlapping work of these similar functions.
    /**
     * This function will return a list of assignment whose name is a part of the Assignement.
     * Using this function we can distinguish assignment1, assignment2.....
     * the total assignment name.
     * @param $assignment_name
     */
    public function get_assignment($assignment_name)
    {
        $new_assignment_list = array();
        foreach ($this->svn_list_info as $list) {
            if (strpos($list->name, $assignment_name) !== false) {
                $new_assignment_list[] = $list;
            }
        }
        return $new_assignment_list;
    }

    /**
     * This function will generate a list from a bigger list
     * In this list, the directory number is limited to 1,2,3 and so on.
     * This function is always used with the function above
     * So that the website is properly managed.
     * @param $assignment_list
     * @param $number_of_slash
     */
    public function get_assignment_with_limit($assignment_list, $number_of_slash)
    {
        $new_array = [];
        foreach ($assignment_list as $element) {
            if (substr_count($element, "/") == $number_of_slash)
                $new_array[] = $element;
        }
    }


    public function get_assignment_with_exact_name($assignment_name)
    {
        $new_assignment_list = array();
        foreach ($this->svn_list_info as $list) {
            if ($assignment_name == $list->name) {
                return $list;
            }
        }
    }

    public function test_load_test_file()
    {
        //Read and parse the elements into Json.
        $svn_log_info = simplexml_load_file("./data/svn_log_small.xml");
        $json = json_encode($svn_log_info);
        $this->svn_log_info_json = json_decode($json, TRUE);

        $svn_list_info = simplexml_load_file("./data/svn_list_small.xml");
        $json = json_encode($svn_list_info);
        $this->svn_list_info_json = json_decode($json, TRUE);

        print_r($this->svn_list_info_json);
        $this->pre_processing();
    }
}


//$p = new parse_all_info();
//$p->test_load_test_file();
