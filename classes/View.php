<?php


class View
{
    public $template = 'default';
    public $page;
    public static $currentPage = NULL;
    public static $lastPage = NULL;

    /**
     * Renders the page where $data can be seen
     * @param array $data
     */
    public function render($data)
    {
        include_once 'views' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $this->template . '.php';
    }
}