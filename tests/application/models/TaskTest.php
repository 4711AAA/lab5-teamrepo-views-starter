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
        $emptyTaskName->task = '';
        $this->assertEquals('Test test', (string) $emptyTaskName->task);
    }

    // tests the alphanumeric + spaces rule for task names
    function testNotAlphanumericSpacesTaskName()
    {
        $notAlphaNumSpcTaskName = new Task();
        $notAlphaNumSpcTaskName->task = 'Test test';
        $this->expectException(Exception::class);
        $notAlphaNumSpcTaskName->task = 'Hello!>?<';
        $this->assertEquals('Test test', (string) $notAlphaNumSpcTaskName->task);
    }

    // tests the max length rule for task names
    function testTooLongTaskName()
    {
        $tooLongTaskName = new Task();
        $tooLongTaskName->task = 'Test test';
        $this->expectException(Exception::class);
        $tooLongTaskName->task = '11111222223333344444555556666611111222223333344444555556666611111';
        $this->assertEquals('Test test', (string) $tooLongTaskName->task);
    }

    /* Priority Tests */

    // test valid priority
    function testValidPriority() {
        $goodPriority = new Task();

        $goodPriority->priority = 3;
        $this->assertEquals(3, $goodPriority->priority);

        $goodPriority->priority = 2;
        $this->assertEquals(2, $goodPriority->priority);

        $goodPriority->priority = 1;
        $this->assertEquals(1, $goodPriority->priority);
    }

    // test priority too big
    function testPriorityTooBig() {
        $tooBig = new Task();

        $this->expectException(Exception::class);
        $tooBig->priority = 4;
    }

    // test for priority is not integer
    function testNotIntegerPriority() {
        $notIntegerPriority = new Task();

        $this->expectException(Exception::class);
        $notIntegerPriority->priority = 'a';
    }

    // test for decimal priority
    function testDecimalPriority() {
        $decimalPriority = new Task();

        $this->expectException(Exception::class);
        $decimalPriority->priority = 1.1;
    }

    // test priority too small
    function testPriorityTooSmall() {
        $tooSmall = new Task();

        $this->expectException(Exception::class);
        $tooSmall->priority = 0;
    }

    /* Size Tests */

    // test valid size
    function testValidSize() {
        $goodSize = new Task();

        $goodSize->size = 3;
        $this->assertEquals(3, $goodSize->size);

        $goodSize->size = 2;
        $this->assertEquals(2, $goodSize->size);

        $goodSize->size = 1;
        $this->assertEquals(1, $goodSize->size);
    }

    // test size too big
    function testSizeTooBig() {
        $sizeTooBig = new Task();

        $this->expectException(Exception::class);
        $sizeTooBig->size = 4;
    }

    // test for size is not integer
    function testNotIntegerSize() {
        $notIntegerSize = new Task();

        $this->expectException(Exception::class);
        $notIntegerSize->size = 'a';
    }

    // test for decimal size
    function testDecimalSize() {
        $decimalSize = new Task();

        $this->expectException(Exception::class);
        $decimalSize->size = 1.1;
    }

    // test size too small
    function testSizeTooSmall() {
        $tooSmall = new Task();

        $this->expectException(Exception::class);
        $tooSmall->size = 0;
    }

    /* Group Tests */

    // test valid group
    function testValidGroup() {
        $goodGroup = new Task();

        $goodGroup->group = 4;
        $this->assertEquals(4, $goodGroup->group);

        $goodGroup->group = 3;
        $this->assertEquals(3, $goodGroup->group);

        $goodGroup->group = 2;
        $this->assertEquals(2, $goodGroup->group);

        $goodGroup->group = 1;
        $this->assertEquals(1, $goodGroup->group);
    }

    // test group too big
    function testGroupTooBig() {
        $groupTooBig = new Task();

        $this->expectException(Exception::class);
        $groupTooBig->group = 5;
    }

    // test for group is not integer
    function testNotIntegerGroup() {
        $notIntegerGroup = new Task();

        $this->expectException(Exception::class);
        $notIntegerGroup->group = 'a';
    }

    // test for group size
    function testDecimalGroup() {
        $decimalGroup = new Task();

        $this->expectException(Exception::class);
        $decimalGroup->group = 1.1;
    }

    // test group too small
    function testGroupTooSmall() {
        $tooSmall = new Task();

        $this->expectException(Exception::class);
        $tooSmall->group = 0;
    }

}