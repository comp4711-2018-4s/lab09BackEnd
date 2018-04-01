<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application
{
    public function index()
    {
        $tasks = $this->tasks->all();   // get all the tasks

        // count how many are not done
        $count = 0;
        foreach ($tasks as $task) {
            if ($task->status != 2) $count++;
        }
        // and save that as a view parameter
        $this->data['remaining_tasks'] = $count;

        // process the array in reverse, until we have five
        $count = 0;
        foreach(array_reverse($tasks) as $task) {
            $task->priority = $this->app->priority($task->priority);
            $display_tasks[] = (array) $task;
            $count++;
            if ($count >= 5) break;
        }
        $this->data['display_tasks'] = $display_tasks;

        $this->data['pagebody'] = 'homepage';
        $this->render();

    }

}
