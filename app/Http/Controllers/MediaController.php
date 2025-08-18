<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchText = $request->searchText;
        $perPage = $request->input('perPage', 20);

        $media = Media::query()
            ->when(
                !empty($searchText),
                fn($q) =>
                $q->where('name', 'like', "%$searchText%")
            )
            ->latest()
            ->paginate($perPage);

        $media->getCollection()->transform(function ($item) {
            $item->path = showImage($item->path, true); // xử lý đường dẫn ảnh
            return $item;
        });

        return successResponse(data: $media, isToastr: false);
    }


    public function upload(Request $request)
    {
        $request->validate([
            'files' => 'required|array|max:10',
            'files.*' => 'file|image|max:10240', // max 10MB mỗi ảnh
        ]);

        try {
            DB::beginTransaction();

            $uploaded = uploadImages($request->file('files'), 'media');

            $inserted = [];

            foreach ($uploaded as $image) {
                $media = Media::create([
                    'name' => $image['name'],
                    'path' => $image['path'],
                    'format' => $image['format'],
                    'size' => $image['size'],
                    'width' => $image['width'],
                    'height' => $image['height'],
                ]);

                $inserted[] = $media;
            }

            DB::commit();

            return response()->json([
                'message' => 'Tải ảnh lên thành công',
            ], 201);
        } catch (\Throwable $e) {
            DB::rollBack();
            logger()->error('Upload thất bại:', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Đã xảy ra lỗi khi tải ảnh lên',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:media,id',
        ]);

        try {
            $mediaList = Media::whereIn('id', $request->ids)->get();

            foreach ($mediaList as $media) {
                deleteImage($media->path);
                $media->delete();
            }

            return response()->json(['message' => 'Đã xoá ảnh thành công']);
        } catch (\Throwable $e) {
            logger()->error('Lỗi xoá ảnh:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Lỗi khi xoá ảnh'], 500);
        }
    }
}
