<?php

namespace App\Http\Controllers\Boilerplate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Boilerplate\UserAPITokens;
use App\Models\Boilerplate\User;
use App\Models\Boilerplate\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class UserApiTokensController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->hasRole('admin')){
            $users = User::whereHas(
                'roles', function($q){
                    $q->where('name', 'company_user');
                }
            )->get();
        }
        return view('boilerplate::user-api-tokens.list', [
            'roles' => Role::all(),
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('boilerplate::user-api-tokens.create', [
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Token Name is Required'
        ];
        $this->validate($request, [
            'name'  => 'required',
        ], $messages);

        $input = $request->all();

        //generate random string of 20 length
        $bytes = random_bytes(20);
        $input['token'] = bin2hex($bytes);
        UserAPITokens::create($input);

        return redirect()->route('boilerplate.user-api-tokens.index')
            ->with('growl', [__('boilerplate::userapitoken.successadd'), 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified chatbot from storage.
     *
     * @param  UserAPITokens  $chatbot
     * @return JsonResponse
     */
    public function destroy(UserAPITokens $userApiToken): JsonResponse
    {
        return response()->json(['success' => $userApiToken->delete() ?? false]);
    }

    protected function button(string $route, string $class, string $icon): string
    {
        $str = '<a href="%s" class="btn btn-sm btn-%s"><i class="fa fa-fw fa-%s"></i></a>';

        return sprintf($str, $route, $class, $icon);
    }

    public function datatable(Request $request)
    {
        $chatbot = UserAPITokens::query('*');

        return Datatables::eloquent($chatbot)
            ->rawColumns(['actions'])
            ->editColumn('actions', function ($token) {
                // ...except delete himself
                $b = $this->button(route('boilerplate.user-api-tokens.destroy', $token->id), 'danger destroy', 'trash');
                return $b;

            })->make(true);
    }
}
