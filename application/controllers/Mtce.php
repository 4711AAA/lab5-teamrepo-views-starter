<?php
/**
 * Created by PhpStorm.
 * User: si-yang
 * Date: 2018-02-14
 * Time: 10:30 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Mtce extends Application
{
    public function index()
    {
        $this->data['pagetitle'] = 'TODO Maintenance List';
        $tasks = $this->tasks->all();   // get all the tasks

        // substitute the status name
        foreach ($tasks as $task) {
            if (!empty($task->status)) {
                $task->status = $this->app->status($task->status);
            }
        }

        // build the task presentation output
        $result = '';
        foreach ($tasks as $task) {
            $result .= $this->parser->parse('oneitem', (array) $task, true);
        }

        /*
        // convert the array of task objects into an array of associate objects
        foreach ($tasks as $task) {
            $converted[] = (array) $task;
        }
        */

        // and them pass them on
        $this->data['display_tasks'] = $result;
        $this->data['pagebody'] = 'itemlist';

        $this->render();
    }
}