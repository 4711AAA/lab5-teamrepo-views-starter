<?php
use PHPUnit\Framework\TestCase;

// Tests for the TaskListTest class
class TaskListTest extends TestCase {

    // set up tests
    function setUp()
    {
        $this->CI = &get_instance();
        $this->CI->load->model('tasks');
        $this->CI->load->model('task');
        $this->tasks = new Tasks();
    }

    // test for uncompleted tasks
    function testMoreUncompletedTasks() {
        $uncompleted = 0;
        $completed = 0;

        foreach ($this->tasks->all() as $task) {
            if ($task->status == 2) { // if status of task is completed
                $completed++;
            } else {
                $uncompleted++;
            }
        }
        $this->assertGreaterThan($completed, $uncompleted); // uncompleted is more than completed
    }
}