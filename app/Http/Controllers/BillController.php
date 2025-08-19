<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillRequest;
use App\Models\Bill;
use App\Models\BillFile;
use App\Models\User;
use App\Traits\DataTables;
use App\Traits\QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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

            $credentials['slug'] = Str::slug($credentials['name']);

            $credentials['user_id'] = Auth::id();

            $bill = Bill::create($credentials);

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $uploadedFile) {
                    $filename = time() . '_' . $uploadedFile->getClientOriginalName();

                    $path = $uploadedFile->storeAs('bill_files', $filename, 'public');

                    $bill->files()->create(['file_path' => $path]);
                }
            }


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

        $oldFiles = $bill->files->map(fn($f) => [
            'source' => asset('storage/' . $f->file_path),
            'options' => [
                'type' => 'local',
                'file' => [
                    'name' => basename($f->file_path),
                    'size' => Storage::size($f->file_path), // thêm size
                ],
                'metadata' => [
                    'id' => $f->id,
                ],
            ],
        ])->values()->toArray();


        return view('pages.bills.form', compact('title', 'bill', 'oldFiles'));
    }

    public function update($company, BillRequest $request, Bill $bill)
    {
        return transaction(function () use ($request, $bill) {
            $credentials = $request->validated();

            if (!empty($credentials['other_information'])) {
                $tagsArray = json_decode($credentials['other_information'], true);
                $tags = array_map(fn($tag) => $tag['value'], $tagsArray);
                $credentials['other_information'] = $tags;
            }

            $credentials['slug'] = Str::slug($credentials['name']);

            $bill->update($credentials);

            // === Xử lý files ===
            // Danh sách file id còn giữ lại (từ client gửi về)
            $keepFileIds = $request->input('keep_files', []); // dạng array

            // Xóa file cũ không còn giữ
            $bill->files()
                ->whereNotIn('id', $keepFileIds)
                ->each(function ($file) {
                    Storage::disk('public')->delete($file->file_path);
                    $file->delete();
                });

            // Upload file mới
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $uploadedFile) {

                    if (is_string($uploadedFile)) {
                        continue;
                    } else {
                        $filename = time() . '_' . $uploadedFile->getClientOriginalName();
                        $path = $uploadedFile->storeAs('bill_files', $filename, 'public');
                        $bill->files()->create(['file_path' => $path]);
                    }
                }
            }

            return successResponse(
                message: "Cập nhật hóa đơn thành công.",
                code: Response::HTTP_OK,
                isToastr: $request->input('submit_action') === 'save_exit'
            );
        });
    }


    public function certificate($phone, $slug, Request $request)
    {

        $phone = $request->segment(1);

        $user = User::query()->where('phone', $phone)->firstOrFail();

        $bill = Bill::query()->where(['slug' => $slug, 'user_id' => $user->id])->with(['files'])->firstOrFail();

        if ($phone !== $user->phone) abort(404);

        return view('pages.bills.certificate', compact('bill', 'user'));
    }
}
