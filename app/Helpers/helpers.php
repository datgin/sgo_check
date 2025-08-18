<?php

use App\Models\Media;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;


if (!function_exists('transaction')) {
    function transaction($callback, $onError = null)
    {
        DB::beginTransaction();
        try {
            $result = $callback();
            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();

            if ($onError && is_callable($onError)) {
                $onError($e);
            }

            Log::error('Exception Details:', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return errorResponse('Có lỗi xảy ra, vui lòng thử lại sau!');
        }
    }
}

if (!function_exists('successResponse')) {
    function successResponse($message = 'call api successful', $data = null, $code = 200, bool $isResponse = true, bool $isToastr = true)
    {
        $response = ['success' => true, 'message' => $message, 'data' => $data, 'code' => $code];

        if ($isToastr) session()->flash('success', $message);

        return $isResponse ? response()->json($response, $code) : $response;
    }
}

if (!function_exists('errorResponse')) {
    function errorResponse(string $message, $code = 500, bool $isResponse = true)
    {
        $response = [
            'success' => false,
            'message' => $message,
            'code' => $code
        ];
        return $isResponse ? response()->json($response, $code) : $response;
    }
}

if (!function_exists('uploadImages')) {
    function uploadImages(
        array $images,
        string $directory = 'images',
        bool $resize = false,
        int $width = 150,
        int $height = 150,
        int $quality = 80
    ) {
        $paths = [];
        $manager = new ImageManager(['driver' => 'gd']);
        $storagePath = storage_path('app/public/' . trim($directory, '/'));

        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0777, true);
        }

        foreach ($images as $key => $image) {
            if ($image instanceof UploadedFile) {
                try {
                    $img = $manager->make($image->getRealPath());

                    if ($resize) {
                        $img->resize($width, $height, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });
                    }

                    // Chuẩn hóa tên
                    $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    $slugName = Str::slug($originalName);
                    $extension = 'webp';

                    $finalSlug = $slugName;
                    $filename = "$finalSlug.$extension";
                    $relativePath = "$directory/$filename";

                    $counter = 1;
                    // Kiểm tra xem file đã tồn tại trong database hoặc storage
                    while (
                        Media::where('name', $filename)->exists() ||
                        Storage::disk('public')->exists($relativePath)
                    ) {
                        $finalSlug = "$slugName ($counter)";
                        $filename = "$finalSlug.$extension";
                        $relativePath = "$directory/$filename";
                        $counter++;
                    }

                    // Lưu file
                    Storage::disk('public')->put($relativePath, $img->encode($extension, $quality));

                    $paths[$key] = [
                        'name' => $filename,
                        'path' => $relativePath,
                        'format' => $extension,
                        'size' => $img->filesize(), // dùng ảnh nén
                        'width' => $img->width(),
                        'height' => $img->height(),
                    ];
                } catch (\Throwable $e) {
                    // Xoá ảnh đã lưu nếu có lỗi
                    foreach ($paths as $uploaded) {
                        Storage::disk('public')->delete($uploaded['path']);
                    }
                    throw $e;
                }
            }
        }

        return $paths;
    }
}

if (!function_exists('deleteImage')) {
    function deleteImage($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}

if (!function_exists('showImage')) {
    function showImage(?string $absoluteUrl, $isFullPath = false, $isEmptyPath = false): ?string
    {
        if (!$absoluteUrl) {
            return !$isEmptyPath ? asset('assets/images/image-default.png') : null;
        }

        $parsedPath = parse_url($absoluteUrl, PHP_URL_PATH);
        $relativePath = ltrim(str_replace('/storage/', '', $parsedPath), '/');

        /** @var \Illuminate\Contracts\Filesystem\Filesystem|\Illuminate\Filesystem\FilesystemAdapter $storage */
        $storage = Storage::disk('public');

        if ($storage->exists($relativePath)) {
            return $isFullPath ? $storage->url($absoluteUrl) : $absoluteUrl;
        }

        return !$isEmptyPath ? asset('assets/images/image-default.png') : null;
    }
}
