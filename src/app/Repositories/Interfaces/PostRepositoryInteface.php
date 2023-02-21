<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

/**
 *
 */
interface PostRepositoryInteface
{

    /**
     * @param array $data
     * @return mixed
     */
    public function save(array $data);

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
