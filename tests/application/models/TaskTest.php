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

    /* Task Tests */

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
        $emptyTaskName->task = 'Test test';
        $this->expectException(Exception::class);
        $emptyTaskName->setTask('');
        $this->assertEquals('Test test', (string) $emptyTaskName->task);
    }

    // tests the alphanumeric + spaces rule for task names
    function testNotAlphanumericSpacesTaskName()
    {
        $notAlphaNumSpcTaskName = new Task();
        $notAlphaNumSpcTaskName->task = 'Test test';
        $this->expectException(Exception::class);
        $notAlphaNumSpcTaskName->setTask('Hello!>?<');
        $this->assertEquals('Test test', (string) $notAlphaNumSpcTaskName->task);
    }

    // tests the max length rule for task names
    function testTooLongTaskName()
    {
        $tooLongTaskName = new Task();
        $tooLongTaskName->task = 'Test test';
        $this->expectException(Exception::class);
        $tooLongTaskName->setTask('11111222223333344444555556666611111222223333344444555556666611111');
        $this->assertEquals('Test test', (string) $tooLongTaskName->task);
    }

    /* Priority Tests */

    // test valid priority
    function testValidPriority () {
        $goodPriority = new Task();

        $goodPriority->setTask(3);
        $this->assertEquals(3, $goodPriority->task);

        $goodPriority->setTask(2);
        $this->assertEquals(2, $goodPriority->task);

        $goodPriority->setTask(1);
        $this->assertEquals(1, $goodPriority->task);
    }

    // testing invalid priority entries
    function testInvalidPriority() {
        $badPriority = new Task();

        $this->expectException(Exception::class);
        $badPriority->setPriority(4);
    }
}