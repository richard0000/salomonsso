<?php
namespace App\Http\Controllers;

use App\Church;
use Illuminate\Http\Request;

class ChurchController extends Controller
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
        $churches = Church::search($request->only('filter'))
            ->paginate();

        return $this->success($churches, 200);
    }
    /**
     * Create a new church in the database
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validateStore($request);

        $church = Church::create($request->all());

        return $this->success("The church with with id {$church->id} has been created", 201);
    }
    /**
     * Retrieves a church and its related data
     *
     * @return void
     */
    public function show($id)
    {
        $church = Church::find($id);

        if (!$church) {
            return $this->error("The church with {$id} doesn't exist", 404);
        }

        return $this->success($church, 200);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
        $church = Church::findOrFail($id);

        if (!$church) {
            return $this->error("The church with {$id} doesn't exist", 404);
        }

        $this->validateUpdate($request, $church);

        $church->update($request->all());

        return $this->success("The church with with id {$church->id} has been updated", 200);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {
        $church = Church::find($id);

        if (!$church) {
            return $this->error("The church with {$id} doesn't exist", 404);
        }

        $church->delete();

        return $this->success("The church with with id {$id} has been deleted", 200);
    }
    /**
     * Validate fields in request for store church operation
     *
     * @return void
     */
    public function validateStore(Request $request)
    {
        $rules = [
            'email' => 'email',
            'name'  => 'required|unique:churches',
        ];

        $this->validate($request, $rules);
    }
    /**
     * Validate fileds in request for update church operation
     *
     * @return void
     */
    public function validateUpdate(Request $request, church $church)
    {
        $rules = [
            'email' => 'email',
            'name'  => 'required|unique:churches,name,' . $church->id,
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
        $resource = "churches";

        return $this->authorizechurch($request, $resource);
    }
}
