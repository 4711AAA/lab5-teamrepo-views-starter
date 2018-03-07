<?php

class Task extends Entity
{
    protected $id;
    protected $task;
    protected $priority;
    protected $size;
    protected $group;
    protected $deadline;
    protected $status;
    protected $flag;

    // insist that an ID be present and be a positive integer
    public function setId($value) {
        if (empty($value)) {
            throw new Exception('ID cannot be empty');
        }
        if (!is_numeric($value)) {
            throw new Exception('ID must be a number');
        }
        if (!is_int($value)) {
            throw new Exception('ID must be an integer');
        }
        if ($value < 1) {
            throw new Exception('ID must be a positive number');
        }
        $this->id = $value;
        return $this;
    }

    // insist that a task name be present, is alphanumeric + spaces, and a max length 64 characters
    public function setTask($value) {
        if (empty($value)) {
            throw new Exception('Task name cannot be empty');
        }
        if (ctype_alnum(str_replace(array(' '), '', $value ))) {
            throw new Exception('Task name must consist of alphanumerics and spaces');
        }
        if (strlen($value) > 64) {
            throw new Exception('Task name is longer than 64 characters');
        }
        $this->task = $value;
        return $this;
    }

    // insist that a priority level be present and be a number between 1 and 3
    public function setPriority($value) {
        if (empty($value)) {
            throw new Exception('Priority cannot be empty');
        }
        if (!is_numeric($value)) {
            throw new Exception('Priority must be a number');
        }
        if ($value < 1 || $value > 3) {
            throw new Exception('Priority must be a number between 1 and 3');
        }
        $this->priority = $value;
        return $this;
    }

    // insist that the task size be present and be a number between 1 and 3
    public function setSize($value) {
        if (empty($value)) {
            throw new Exception('Size cannot be empty');
        }
        if (!is_numeric($value)) {
            throw new Exception('Size must be a number');
        }
        if ($value < 1 || $value > 3) {
            throw new Exception('Size must be a number between 1 and 3');
        }
        $this->size = $value;
        return $this;
    }

    // insist that the group be present and be a number between 1 and 4
    public function setGroup($value) {
        if (empty($value)) {
            throw new Exception('Group cannot be empty');
        }
        if (!is_numeric($value)) {
            throw new Exception('Group must be a number');
        }
        if ($value < 1 || $value > 4) {
            throw new Exception('Group must be a number between 1 and 4');
        }
        $this->group = $value;
        return $this;
    }
}