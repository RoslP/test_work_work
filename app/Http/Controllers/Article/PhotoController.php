<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessPhoto;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'photos.*' => 'required|file|mimes:jpeg,png,heic,heif',
        ]);

        $processedPhotos = [];

        foreach ($request->file('photos') as $photo) {
            // Сохраняем во временную папку
            $path = $photo->store('tmp/photos');

            // Если нужно, можно создать запись в БД сразу
            $photoRecord = Photo::create([
                'article_id' => 1,
                'filename' => $photo->getClientOriginalName(),
                'original_path' => $path,
                'status' => 'pending',
                // другие поля...
            ]);

            // Передаем в очередь ID записи или путь
            ProcessPhoto::dispatch($photoRecord->id, $path);

            $processedPhotos[] = $photoRecord;
        }

        return response()->json([
            'message' => 'Photos are being processed',
            'photos' => $processedPhotos,
        ]);
    }
}

