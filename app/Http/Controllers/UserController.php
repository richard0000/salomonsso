<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*
    public function __construct()
    {
    $this->middleware('oauth', ['except' => ['index', 'show']]);
    $this->middleware('authorize:' . __CLASS__, ['except' => ['index', 'show']]);
    }
     */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $users = User::search($request->only('filter'))
            ->paginate();

        return $this->success($users, 200);
    }
    /**
     * Create a new user in the database
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validateStore($request);

        $request['password'] = Hash::make($request->get('password'));
        $user                = User::create($request->all());

        return $this->success("The user with with id {$user->id} has been created", 201);
    }
    /**
     * Retrieves a user and its related data
     *
     * @return void
     */
    public function show($id)
    {
        $user = User::with('occupation')->find($id);

        if (!$user) {
            return $this->error("The user with {$id} doesn't exist", 404);
        }

        return $this->success($user, 200);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (!$user) {
            return $this->error("The user with {$id} doesn't exist", 404);
        }

        $this->validateUpdate($request, $user);

        $request['password'] = Hash::make($request->get('password'));

        $user->update($request->all());

        return $this->success("The user with with id {$user->id} has been updated", 200);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->error("The user with {$id} doesn't exist", 404);
        }
        $user->delete();
        return $this->success("The user with with id {$id} has been deleted", 200);
    }
    /**
     * Validate fields in request for store user operation
     *
     * @return void
     */
    public function validateStore(Request $request)
    {
        $rules = [
            'email'         => 'required|email|unique:users',
            'password'      => 'required|min:6',
            'church_id'     => 'required',
            'gender'        => 'in:M,F',
            'civil_status'  => 'in:C,S,D,V',
            'occupation_id' => 'exists:occupations,id',
        ];

        $this->validate($request, $rules);
    }
    /**
     * Validate fileds in request for update user operation
     *
     * @return void
     */
    public function validateUpdate(Request $request, User $user)
    {
        $rules = [
            'email'         => 'email|unique:users,email,' . $user->id,
            'password'      => 'min:6',
            'gender'        => 'in:M,F',
            'civil_status'  => 'in:C,S,D,V',
            'occupation_id' => 'exists:occupations,id',
        ];

        $this->validate($request, $rules);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function isAuthorized(Request $request)
    {
        $resource = "users";

        return $this->authorizeUser($request, $resource);
    }
}
