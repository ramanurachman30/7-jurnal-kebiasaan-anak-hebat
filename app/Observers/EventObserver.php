<?php

namespace App\Observers;

use App\Models\Event;
use App\Services\ContentInvitationService;
use App\Services\EventScheduleService;
use App\Services\GiftService;
use App\Services\ImageContentService;
use App\Services\InvitationService;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class EventObserver
{
    protected $contentInvitationService;
    protected $imageContentService;
    protected $giftService;
    protected $invitationService;
    protected $eventScheduleService;
    protected ImageManager $imageManager;

    public function __construct(ImageManager $imageManager)
    {
        $this->contentInvitationService = app(ContentInvitationService::class);
        $this->imageContentService = app(ImageContentService::class);
        $this->giftService = app(GiftService::class);
        $this->invitationService = app(InvitationService::class);
        $this->eventScheduleService = app(EventScheduleService::class);
        $this->imageManager = $imageManager;
    }
    public function saving(Event $events)
    {
        $fileCodes = [];

        if (request()->hasFile('image_content')) {
            foreach (request()->file('image_content') as $uploadedFile) {
                if ($uploadedFile->isValid()) {
                    $fileCodes[] = $this->writeFile($uploadedFile);
                }
            }
        }
        $events->setRelation('uploadedFileCodes', $fileCodes);
    }
    /**
     * Handle the Event "created" event.
     */
    public function created(Event $events): void
    {
        $requestData = request()->all();
        if (isset($requestData['content_invitation'])) {
            $fileCodes = $events->getRelation('uploadedFileCodes') ?? [];
            $contentInvitation = $this->contentInvitationService->store($requestData['content_invitation'], $events->id);
            if (count($fileCodes) > 0) {
                $this->imageContentService->store($fileCodes, $contentInvitation->id);
            }
            if (isset($requestData['gift'])) {
                $this->giftService->store($requestData['gift'], $contentInvitation->id);
            }
        }
        if (isset($requestData['invitation'])) {
            $invitation = $this->invitationService->store($requestData['invitation'], $events->id);
        }
        if (isset($requestData['event_schedules'])) {
            $this->eventScheduleService->store($requestData['event_schedules'], $events->id);
        }
    }

    public function updating(Event $event)
    {
        $request = request();
        // Hapus file lama yang dihapus user
        if ($request->has('removed_image_content')) {
            $removedIds = $request->input('removed_image_content');

            foreach ($removedIds as $id) {
                $imageContent = $this->imageContentService->find((int)$id);
                if ($imageContent) {
                    // Hapus file fisik
                    $originalPath = storage_path('app/public/image/origin/' . $imageContent->extension . '/' . $imageContent->original_name);
                    $compressedPath = public_path('storage/image/compress/' . $imageContent->extension . '/' . $imageContent->compressed_name);

                    if (file_exists($originalPath)) unlink($originalPath);
                    if (file_exists($compressedPath)) unlink($compressedPath);

                    $this->imageContentService->delete((int)$id);
                }
            }
        }

        if ($request->hasFile('image_content')) {
            $fileCodes = [];
            foreach ($request->file('image_content') as $uploadedFile) {
                if ($uploadedFile->isValid()) {
                    $fileCodes[] = $this->writeFile($uploadedFile);
                }
            }
            $event->setRelation('uploadedFileCodes', $fileCodes);
        }
    }

    /**
     * Handle the Event "updated" event.
     */
    public function updated(Event $event)
    {
        $request = request();
        $fileCodes = $event->getRelation('uploadedFileCodes') ?? [];

        // Update content invitation
        if ($request->has('content_invitation')) {
            $contentInvitation = $this->contentInvitationService->update(
                $request->input('content_invitation'),
                (int)$event->id
            );
            // Simpan file baru terkait content invitation
            if (count($fileCodes) > 0) {
                $this->imageContentService->store($fileCodes, $contentInvitation->id);
            }

        }
    }

    /**
     * Handle the Event "deleted" event.
     */
    public function deleted(Event $events): void
    {
        //
    }

    /**
     * Handle the Event "restored" event.
     */
    public function restored(Event $events): void
    {
        //
    }

    /**
     * Handle the Event "force deleted" event.
     */
    public function forceDeleted(Event $events): void
    {
        //
    }

    public function writeFile($file, $desc = "")
    {
        $imageType = ['jpg', 'jpeg', 'png', 'webp'];
        $files = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'zip', 'mp4', 'mov'];

        $code = Str::random(15);
        $ext = strtolower($file->getClientOriginalExtension());
        $this->saveAsImage($file, $code, $desc);

        return $code;
    }

    public function saveAsImage($file, $code, $desc)
    {
        $path = 'image/origin/';
        $mimeType = $file->getClientMimeType();
        $extArray = explode('/', $mimeType);
        $ext = $extArray[1];
        $path .= $ext;

        $file->store($path, 'public');

        $dataFile = [
            'code' => $code,
            'name' => $file->getClientOriginalName(),
            'original_name' => $file->hashName(),
            'compressed_name' => $this->writeFileCompress($file),
            'description' => $desc,
            'mimetype' => $file->getClientMimeType()
        ];

        DB::table('files')->insert($dataFile);

        return $code;
    }
    public function writeFileCompress($file)
    {
        $mimeType = $file->getClientMimeType();
        $extArray = explode('/', $mimeType);
        $ext = $extArray[1];
        $directory = public_path('storage/image/compress/' . $ext);

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $name = $file->hashName();
        $path = $directory . '/' . $name;

        $image = $this->imageManager->read($file->getRealPath());
        $image->scale(900, 720, true);
        $image->toJpeg()->save($path);

        return $name;
    }
}
