<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\SendAccountInformation;
use App\Models\User;
use App\Traits\DataTables;
use App\Traits\QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    use QueryBuilder;
    use DataTables;
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = $this->queryBuilder(
                model: new User,
                wheres: [['column' => 'id', 'operator' => '<>', 'value' => Auth::id()]]
            );

            return $this->processDataTable(
                $query,
                fn($dataTable) =>

                $dataTable->addColumn(
                    'operations',
                    fn($row) =>
                    view('components.operation', [
                        'row' => $row,
                        'urlEdit' => "clients/{$row->id}",
                    ])->render()

                )->editColumn('id', fn($row) => $row->id . ' | <small>' . $row->created_at->format('d/m/Y') . '</small>'),
                ['id', 'operations']
            );
        }

        return view('pages.clients.index');
    }

    public function create()
    {
        $user = null;
        $title = 'Tạo mới khách hàng';
        return view('pages.clients.form', compact('user', 'title'));
    }

    public function store(RegisterRequest $request)
    {
        return transaction(function () use ($request) {

            $crendentials = $request->validated();

            $crendentials['email_verified_at'] = now();

            $user =  User::create($crendentials);

            Mail::to($crendentials['email'])
                ->queue((new SendAccountInformation($user, $crendentials['password']))->afterCommit());

            return successResponse(
                message: "Tạo khách hàng thành công.",
                code: Response::HTTP_CREATED,
                isToastr: $request->input('submit_action') === 'save_exit'
            );
        });
    }

    public function edit($company, User $user)
    {
        $title = "Cập nhật khách hàng - {$user->name}";

        return view('pages.clients.form', compact('user', 'title'));
    }

    public function update($company, RegisterRequest $request, User $user)
    {
        return transaction(function () use ($request, $user) {

            $credentials = $request->validated();

            // Cập nhật thông tin người dùng (model tự hash password nếu có)
            $user->update($credentials);

            // Nếu muốn gửi mail khi password được thay đổi
            if (isset($credentials['password'])) {
                Mail::to($user->email)
                    ->queue((new SendAccountInformation($user, $request->input('password')))->afterCommit());
            }

            return successResponse(
                message: "Cập nhật khách hàng thành công.",
                code: Response::HTTP_OK,
                isToastr: $request->input('submit_action') === 'save_exit'
            );
        });
    }
}
