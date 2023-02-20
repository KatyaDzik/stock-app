<?php

namespace App\Services\PostServiceInterface;

interface PostServiceInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param int $id
     * @return mixed
     */
    public function read(int $id);

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);
}
