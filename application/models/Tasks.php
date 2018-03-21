<?php


class Tasks extends XML_Model
{
    private $CI;

    public function __construct()
    {
        parent::__construct(APPPATH . '../data/tasks.xml', 'id');
        $this->CI = &get_instance();
    }

    function getCategorizedTasks()
    {
        // extract the undone tasks
        foreach ($this->all() as $task)
        {
            if ($task->status != 2)
                $undone[] = $task;
        }

        // substitute the category name, for sorting
        foreach ($undone as $task)
            $task->group = $this->CI->app->group($task->group);

        // order them by category
        usort($undone, "orderByCategory");

        // convert the array of task objects into an array of associative objects
        foreach ($undone as $task)
            $converted[] = (array) $task;

        return $converted;
    }

    // provide form validation rules
    public function rules()
    {
        $config = array(
            ['field' => 'desc', 'label' => 'TODO task', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
            ['field' => 'priority', 'label' => 'Priority', 'rules' => 'integer|less_than[4]'],
            ['field' => 'size', 'label' => 'Task size', 'rules' => 'integer|less_than[4]'],
            ['field' => 'group', 'label' => 'Task group', 'rules' => 'integer|less_than[5]'],
        );
        return $config;
    }

    // Loads data from the xml file
    protected function load()
    {
        if (file_exists(realpath($this->_origin))) {

            $this->xml = simplexml_load_file(realpath($this->_origin));
            if ($this->xml === false) {
                // error so redirect or handle error
                header('location: /404.php');
                exit;
            }

            $xmlarray =$this->xml;

            //if it is empty;
            if(empty($xmlarray)) {
                return;
            }

            //get all xmlonjects into $xmlcontent
            $rootkey = key($xmlarray);
            $xmlcontent = (object)$xmlarray->$rootkey;

            $keyfieldh = array();
            $first = true;

            //if it is empty;
            if(empty($xmlcontent)) {
                return;
            }

            $dataindex = 1;
            $first = true;
            foreach ($xmlcontent as $oj) {
                if($first){
                    foreach ($oj as $key => $value) {
                        $keyfieldh[] = $key;
                        //var_dump((string)$value);
                    }
                    $this->_fields = $keyfieldh;
                }

                $first = false;

                //var_dump($oj->attributes());
                //var_dump($oj->children());
                $one = new stdClass();

                // gets the ID of the task
                foreach ($oj->attributes() as $key => $value) {
                    $one->$key = (string) $value;
                }


                // get objects one by one
                foreach ($oj as $key => $value) {
                    if ($key == 'desc') {
                        $one->task = (string) $value;
                    }
                    else {
                        $one->$key = (string) $value;
                    }

                }
                $this->_data[$dataindex++] =$one;
            }


            //var_dump($this->_data);
        } else {
            exit('Failed to open the xml file.');
        }
    }
}

// return -1, 0, or 1 of $a's category name is earlier, equal to, or later than $b's
function orderByCategory($a, $b)
{
    if ($a->group < $b->group)
        return -1;
    elseif ($a->group > $b->group)
        return 1;
    else
        return 0;
}