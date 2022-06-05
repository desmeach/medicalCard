<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

class_alias('\RedBeanPHP\R', '\R');

class Database implements IDatabase
{
    private string $userName;
    private string $name;
    private string $host;
    private string $password;

    /**
     * @param $userName string
     * @param $password string
     * @param $host string
     * @param $name string name of database
     */
    public function __construct(string $userName, string $password, string $host, string $name)
    {
        $this->userName = $userName;
        $this->password = $password;
        $this->host = $host;
        $this->name = $name;
    }


    /**
     * openConnection
     *
     * @return void
     */
    public function openConnection()
    {
        R::setup("mysql:host=$this->host;dbname=$this->name", $this->userName, $this->password);
    }

    /**
     * closeConnection
     *
     * @return void
     */
    public function closeConnection()
    {
        R::close();
    }
}