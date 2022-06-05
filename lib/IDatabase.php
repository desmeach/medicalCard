<?php

interface IDatabase
{
    public function openConnection();
    public function closeConnection();
}