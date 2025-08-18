<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillRequest;
use App\Models\Bill;
use App\Models\User;
use App\Traits\DataTables;
use App\Traits\QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BillController extends Controller
{
    use QueryBuilder;
    use DataTables;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = $this->queryBuilder(
                model: new Bill,
                wheres: [['column' => 'user_id', 'value' => Auth::id()]]
            );

            return $this->processDataTable(
                $query,
                fn($dataTable) =>

                $dataTable->addColumn(
                    'operations',
                    fn($row) =>
                    view('components.operation', [
                        'row' => $row,
                        'urlEdit' => "bills/{$row->id}",
                    ])->render()

                )
                    ->editColumn('production_date', fn($row) => $row->production_date ? $row->production_date->format('d/m/Y') : '')
                    ->editColumn('id', fn($row) => $row->id . ' | <small>' . $row->created_at->format('d/m/Y') . '</small>'),
                ['id', 'operations']
            );
        }

        return view('pages.bills.index');
    }

    public function create()
    {
        $title = "Tạo mới phiếu xác nhận";
        $bill = null;

        return view('pages.bills.form', compact('title', 'bill'));
    }

    public function store(BillRequest $request)
    {
        return transaction(function () use ($request) {
            $credentials = $request->validated();

            if (!empty($credentials['other_information'])) {
                // Giải mã chuỗi JSON thành mảng
                $tagsArray = json_decode($credentials['other_information'], true);

                $tags = array_map(fn($tag) => $tag['value'], $tagsArray);

                $credentials['other_information'] = $tags;
            }

            $credentials['user_id'] = Auth::id();

            Bill::create($credentials);

            return successResponse(
                message: "Tạo phiếu xác nhận thành công.",
                code: Response::HTTP_CREATED,
                isToastr: $request->input('submit_action') === 'save_exit'
            );
        });
    }

    public function edit($company, Bill $bill)
    {
        $title = "Cập nhật phiếu xác nhận - {$bill->name}";

        return view('pages.bills.form', compact('title', 'bill'));
    }
    public function update($company, BillRequest $request, Bill $bill)
    {
        return transaction(function () use ($request, $bill) {
            $credentials = $request->validated();

            if (!empty($credentials['other_information'])) {
                // Giải mã chuỗi JSON thành mảng
                $tagsArray = json_decode($credentials['other_information'], true);

                $tags = array_map(fn($tag) => $tag['value'], $tagsArray);

                $credentials['other_information'] = $tags;
            }

            $bill->update($credentials);

            return successResponse(
                message: "Cập nhật hóa đơn thành công.",
                code: Response::HTTP_OK,
                isToastr: $request->input('submit_action') === 'save_exit'
            );
        });
    }

    public function certificate($company, Bill $bill, Request $request)
    {
        $token = $request->query('token');

        if (!$token) {
            abort(403, 'Token không hợp lệ');
        }

        // Giải mã
        $decoded = json_decode(base64_decode($token), true);

        // dd($decoded['company']);

        if (!$decoded) {
            abort(403, 'Token sai định dạng');
        }

        // Nếu bạn muốn lấy user trong DB dựa theo id
        $user = null;
        if (isset($decoded['id'])) {
            $user = User::find($decoded['id']);
        }

        return view('pages.bills.certificate', compact('bill', 'user', 'decoded'));
    }
}
