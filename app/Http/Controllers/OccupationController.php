<?php
namespace App\Http\Controllers;

use App\Occupation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OccupationController extends Controller
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
        $occupations = Occupation::search($request->only('filter'))
            ->paginate();

        return $this->success($occupations, 200);
    }
    /**
     * Create a new occupation in the database
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validateStore($request);

        $request['password'] = Hash::make($request->get('password'));
        $occupation          = Occupation::create($request->all());

        return $this->success("The occupation with with id {$occupation->id} has been created", 201);
    }
    /**
     * Retrieves a occupation and its related data
     *
     * @return void
     */
    public function show($id)
    {
        $occupation = Occupation::find($id);

        if (!$occupation) {
            return $this->error("The occupation with {$id} doesn't exist", 404);
        }

        return $this->success($occupation, 200);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
        $occupation = Occupation::findOrFail($id);

        if (!$occupation) {
            return $this->error("The occupation with {$id} doesn't exist", 404);
        }

        $this->validateUpdate($request, $occupation);

        $occupation->update($request->all());

        return $this->success("The occupation with with id {$occupation->id} has been updated", 200);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {
        $occupation = Occupation::find($id);
        if (!$occupation) {
            return $this->error("The occupation with {$id} doesn't exist", 404);
        }
        $occupation->delete();
        return $this->success("The occupation with with id {$id} has been deleted", 200);
    }
    /**
     * Validate fields in request for store occupation operation
     *
     * @return void
     */
    public function validateStore(Request $request)
    {
        $rules = [
            'description' => 'required|unique:occupations',
        ];

        $this->validate($request, $rules);
    }
    /**
     * Validate fileds in request for update occupation operation
     *
     * @return void
     */
    public function validateUpdate(Request $request, Occupation $occupation)
    {
        $rules = [
            'description' => 'required|unique:occupations,description,' . $occupation->id,
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
        $resource = "occupations";

        return $this->authorizeoccupation($request, $resource);
    }
}
