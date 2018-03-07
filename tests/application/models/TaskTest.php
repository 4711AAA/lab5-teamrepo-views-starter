<?php
use PHPUnit\Framework\TestCase;

// Tests the Task class
class TaskTest extends TestCase
{
    // set up tests
    function setUp()
    {
        $this->CI = &get_instance();
        $this->CI->load->model('tasks');
        $this->CI->load->model('task');
        $this->tasks = new Tasks();
    }

    // tests task name rules (should pass)
    function testGoodTaskName()
    {
        // creating test variables
        $goodName = new Task();

        $goodName->task = 'Test test';
        $this->assertEquals('Test test', (string) $goodName->task);
    }

    // tests the empty rule for task names
    function testEmptyTaskName()
    {
        $emptyTaskName = new Task();
        $this->expectException(Exception::class);
        $emptyTaskName->task = '';
    }

    // tests the alphanumeric + spaces rule for task names
    function testNotAlphanumericSpacesTaskName()
    {
        $notAlphaNumSpcTaskName = new Task();
        $this->expectException(Exception::class);
        $notAlphaNumSpcTaskName->task = 'Hello!>?<';
    }

    // tests the max length rule for task names
    function testTooLongTaskName()
    {
        $tooLongTaskName = new Task();
        $this->expectException(Exception::class);
        $tooLongTaskName->task = "11111222223333344444555556666611111222223333344444555556666611111";
    }
}