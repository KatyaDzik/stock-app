<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\PostServiceInterface\PostServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserService implements PostServiceInterface, UserServiceInterface
{
    private $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }


    /**
     * @param array $data
     * @return User|null
     * @throws \Exception
     */
    public function create(array $data): ?User
    {
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'role_id' => ['required', 'exists:roles,id'],
            'password' => ['required', 'min:4', 'max:255'],
            'password_confirmed' => ['required', 'same:password'],
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }

        $result = $this->repository->save($data);

        return $result;
    }


    /**
     * @param int $id
     * @return User|null
     */
    public function read(int $id): ?User
    {
        $user = $this->repository->getById($id);

        return $user;
    }


    /**
     * @param array $data
     * @param int $id
     * @return User|null
     * @throws \Exception
     */
    public function update(array $data, int $id): ?User
    {
        $validator = Validator::make($data, [
            'name' => ['string', 'min:2', 'max:255'],
            'role_id' => ['exists:roles,id'],
            'password' => ['min:4', 'max:255'],
            'password_confirmed' => ['same:password'],
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }

        $result = $this->repository->update($data, $id);

        return $result;
    }


    /**
     * @param int $id
     * @return User|null
     * @throws \Exception
     */
    public function delete(int $id): ?User
    {
        $result = $this->repository->delete($id);

        return $result;
    }


    /**
     * @param array $data
     * @return JsonResponse
     */
    public function login(array $data): JsonResponse
    {
        $user = $this->repository->getByName($data['name']);

        if (Hash::check($data['password'], $user->password)) {
            $success['jwt'] = $user->createToken('token')->plainTextToken;
            return response()->json(['jwt' => $success['jwt']]);
        } else {
            return response()->json(['errors' => 'Неправильный логин или пароль'], Response::HTTP_UNAUTHORIZED);
        }
    }
}
