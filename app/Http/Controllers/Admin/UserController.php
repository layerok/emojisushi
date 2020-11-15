<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends BaseController
{

    public function index()
    {
        $records = User::all();
        $this->setPageTitle('Пользователи', 'Пользователи');
        return view('admin.users.index', compact('records'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        $this->setPageTitle('Пользователи', 'Пользователи');
        return view('admin.users.create');
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $clearPhone = preg_replace('/[^\d+]*/', '', $request->input('phone'));
        $request->merge(['phone' => $clearPhone]);

        $this->validate($request, [
            'name'      =>  'max:191',
            'address'   =>  'max:191',
            'phone'     =>  'bail|required|unique:users|max:191',
        ]);
        $params = $request->except('_token');



        $collection = collect($params);
        $collection->put('password' , bcrypt('password'));

        $user = User::create($collection->all());

        if (!$user) {
            return $this->responseRedirectBack('Возникла ошибка создания пользователя.', 'error', true, true);
        }
        return $this->responseRedirect('admin.users.index', 'Пользователь создан успешно' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetRecord = User::findOrFail($id);


        $this->setPageTitle('Пользователи', 'Редактировать пользователь : '.$targetRecord->name);
        return view('admin.users.edit', compact('targetRecord'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $clearPhone = preg_replace('/[^\d+]*/', '', $request->input('phone'));
        $request->merge(['phone' => $clearPhone]);
        $this->validate($request, [
            'name'      =>  'max:191',
            'address'   =>  'max:191',
            'phone'     =>  'bail|required|unique:users|max:191'
        ]);

        $params = $request->except('_token');

        $collection = collect($params);
        $collection->put('password' , bcrypt('password'));

        $user = User::where('id', '=', $params['id'])->update($collection->all());

        if (!$user) {
            return $this->responseRedirectBack('Возникла ошибка обновления пользователя.', 'error', true, true);
        }
        return $this->responseRedirectBack('Пользователь обновлен успешно' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {

        $user = User::find($id);

        if (!$user) {
            return $this->responseRedirectBack('Возникла ошибка при удалении пользователя.', 'error', true, true);
        }
        $user->delete();
        return $this->responseRedirect('admin.users.index', 'Пользователь удален успешно' ,'success',false, false);
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function orders(Request $request)
    {
        $user = User::with('orders')->findOrFail($request->input('id'))->orders()->get();

        return response()->json($user);
    }
}
