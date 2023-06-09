<?php

namespace App\Http\Controllers;

use App\Events\AdminCreatedUser;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Traits\QueryableTrait;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    //
    use QueryableTrait;
    private $user;
    private $userRepo;
    public function __construct(UserRepositoryInterface $userRepo, User $user)
    {   
        $this->user = $user;
        $this->userRepo = $userRepo;
    }
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = $this->user;

            $actionsColumn = [];
            if($request->user()->can('users disable')) {
                $actionsColumn[] = 'disable';
            }
            if($request->user()->can('users edit')) {
                $actionsColumn[] = 'edit';
            }
            if($request->user()->can('users delete')) {
                $actionsColumn[] = 'delete';
            }

            return DataTables::of($data->with('roles'))
                ->addColumn('actions', $actionsColumn)
                ->make(true);
        }
        return view('main.users');
    }
    public function create(Request $request) {

        $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|unique:users,email|email',
            ],
            [
                'name.required' => 'Vui lòng nhập tên người dùng',
                'name.max' => 'Giới hạn :max ký tự',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã tồn tại trong hệ thống'
            ]
        );

        try {
            $email = $request->email;
            $password = str_random(8);
            DB::beginTransaction();
            $this->userRepo->create([
                'name' => $request->name,
                'email' => $email,
                'password' => Hash::make($password)
            ]);
            event(new AdminCreatedUser($email, $password));

            DB::commit();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error ". $e->getMessage(). ' at line '.$e->getLine());
            return response()->json([
                'status' => 'error'
            ], 500);
        }
    }

    public function update(Request $request, $id) {

        $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users,email,'. $id
            ],
            [
                'name.required' => 'Vui lòng nhập tên người dùng',
                'name.max' => 'Giới hạn :max ký tự',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã tồn tại trong hệ thống'
            ]
        );

        try {
            DB::beginTransaction();
            $dataUpdate = [
                'name' => $request->name,
                'email' => $request->email
            ];
            $this->userRepo->update($id, $dataUpdate);
            DB::commit();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error ". $e->getMessage(). ' at line '.$e->getLine());
            return response()->json([
                'status' => 'error'
            ], 500);
        }
    }
    public function disable($id) {
        try {
            $user = $this->userRepo->find($id);
            $user->status = $user->status == 'ACTIVE' ? 'INACTIVE' : 'ACTIVE';
            $user->save();
            
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error'
            ], 500);
        }
    }
    public function delete($id) {
        return $this->deleteData($this->user, $id);
    }

  
}
