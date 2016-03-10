<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 3/8/16
 * Time: 10:43 PM
 */

/**
 * Class assignment_entry
 * This class is for an assignment. An assignment has a name, a kind, its last revision number,
 * its last editing date, and its history recoreds.
 */
class assignment_entry
{
    public $name;
    public $kind;
    public $last_revision;
    public $size;
    public $last_date;
    public $history_records; //The history recores is a list of log that contains all the log info, such as messages.

    public function __construct($name, $kind, $lastrev, $lastdate, $size)
    {
        $this->name = $name;
        $this->kind = $kind;
        $this->size = (int)$size;
        $this->last_revision = (int)$lastrev;
        $this->last_date = $lastdate;
        $this->history_records = array();
    }

    /**
     * This function adds a new records.
     * @param $new_entry
     * @param $revision
     */
    public function add_log_entry($new_entry, $revision)
    {
        $this->history_records[(int)$revision] = $new_entry;
    }

}

?>