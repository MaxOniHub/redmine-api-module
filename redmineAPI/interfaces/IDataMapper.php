<?php

namespace redmineModule\interfaces;

interface IDataMapper
{
    public function getAll();

    public function findById($id);
}