<?php

namespace App\Jobs;

use App\Models\Photo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProcessPhoto implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $photoId;
    protected $path;

    public function __construct($photoId, $path)
    {
        $this->photoId = $photoId;
        $this->path = $path;
    }

    public function handle(): void
    {
        try {
            // Получаем запись из БД
            $photo = Photo::findOrFail($this->photoId);
            $photo->update(['status' => 'processing']);

            // Полный путь к временному файлу
            $tempPath = storage_path('app/' . $this->path);

            // Пример обработки фото:
            // 1. Создаем различные размеры
            $image = Image::make($tempPath);

            // Основное сохранение
            $mainPath = 'photos/' . date('Y/m/d') . '/' . uniqid() . '.jpg';
            Storage::disk('public')->put($mainPath, $image->encode('jpg', 85));

            // Миниатюра
            $thumbnailPath = 'photos/thumbnails/' . date('Y/m/d') . '/' . uniqid() . '.jpg';
            Storage::disk('public')->put($thumbnailPath,
                $image->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode('jpg', 75)
            );

            // 2. Удаляем временный файл
            Storage::delete($this->path);

            // 3. Сохраняем пути в БД
            $photo->update([
                'path' => $mainPath,
                'thumbnail_path' => $thumbnailPath,
                'status' => 'completed',
                'processed_at' => now(),
            ]);

        } catch (\Exception $e) {
            // Обработка ошибок
            if (isset($photo)) {
                $photo->update([
                    'status' => 'failed',
                    'error_message' => $e->getMessage(),
                ]);
            }

            // Можно также логировать ошибку
            \Log::error('Photo processing failed: ' . $e->getMessage());

            // Повторная попытка будет обработана системой очередей
            throw $e;
        }
    }

    public function failed(\Throwable $exception)
    {
        // Действия при окончательной неудаче
        $photo = Photo::find($this->photoId);
        if ($photo) {
            $photo->update(['status' => 'failed']);
        }
    }
}
