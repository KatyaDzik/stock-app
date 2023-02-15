<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function getProducts($id);

    public function getSubcategories($id);
}
