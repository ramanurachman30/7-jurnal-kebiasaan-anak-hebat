<?php

namespace App\Http\Controllers;

use App\Events\Attandance;
use App\Imports\InvitationImport;
use App\Models\Event;
use Illuminate\Http\Request;

use App\Models\Bank;
use App\Models\Invitation;
use App\Models\Template;
use App\Models\Templates;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class EventController extends AppController
{
    protected $table_name = null;
    protected $model;
    protected $forms;
    protected $segment;
    protected $view;
    protected $segmentName;
    protected $reference;

    public function __construct(Request $request, Event $model)
    {
        // dd($model);
        try {
            $this->segment = $request->segment(1);
            if (file_exists(app_path('Models/' . Str::studly($this->segment)) . '.php')) {
                $this->model = app("App\Models\\" . Str::studly($this->segment));
            } else {
                if ($model->checkTableExists($this->segment)) {
                    $this->model = $model;
                    $this->model->setTable($this->segment);
                }
            }

            if (!$this->model) abort(404);

            $this->view = 'backend.' . $this->segment;
            $this->table_name = $this->segment;
            $this->segmentName = Str::studly($this->segment);
            $this->forms = $this->model->getForms();
            $this->reference = $this->model->getReference();
        } catch (Exception $e) {
            //throw $th;
        }
    }

    public function list()
    {
        $this->view = view('backend.event.list', ['forms' => $this->forms]);
        // dd($this->segment);
        return $this->view->with(
            [
                'forms' => $this->forms,
                'segmentName' => $this->segmentName
            ]
        );
    }
    public function create()
    {
        $templates = Template::get();
        $bankAccounts = Bank::get();
        $data = [
            "templates" => $templates,
            "bankAccounts" => $bankAccounts,
        ];
        return view('backend.event.create', compact('data'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Simpan event ke database
            $event = Event::create($request->input('event'));

            DB::commit();
            return redirect('admin/dashboard');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Store Event Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->withInput()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
            // return back()->withInput()->withErrors($e->getMessage());
        }
    }
    public function edit(Request $request)
    {
        $event = Event::with([
            'contentInvitations.imageContents',
            'contentInvitations.gift',
            'invitation',
            'eventschedule',
        ])->findOrFail($request->id);
        $data = [
            'templates' => $this->getTemplates(),
            'bankAccounts' => $this->getBankAccounts(),
        ];
        $formData = $this->transformEventDataForForm($event);
        $form = [
            'event' => $event,
            'data' => $data,
            'formData' => $formData
        ];

        return view('backend.event.edit', compact('event', 'data', 'formData'));
    }

    public function update(Request $request)
    {

        DB::beginTransaction();
        try {
            $event = Event::findOrFail($request->id);
            $event->fill($request->input('event'));
            $event->save(); 
            DB::commit();

            return redirect('admin/dashboard');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors('Update failed: ' . $e->getMessage());
        }
    }

    public function guest($eventId)
    {
        $event = Event::findOrFail($eventId);
        $this->model = new Invitation();
        $this->segmentName = 'invitations';
        $this->table_name = 'invitations';
        $this->forms = $this->model->getForms();
        $this->reference = $this->model->getReference();
        $this->view = view('backend.event.guest', ['forms' => $this->forms]);
        return $this->view->with(
            [
                'forms' => $this->forms,
                'segmentName' => $this->segmentName,
                'event' => $event,
            ]
        );
    }
    public function attandance($eventId)
    {
        return view('backend.event.attandance');
    }
    public function listener($eventId)
    {
        
        $event = Event::with([
            'contentInvitations' => function ($query) {
                $query->with(['imageContents']);
            }
        ])->findOrFail($eventId)->toArray();
        return view('backend.event.listener', compact('event'));
    }
    public function present($eventId, Request $request)
    {
        $guest = Invitation::where([
            'wedding_id' => $eventId,
            'qr_code' => $request->qr_code
        ])->firstOrFail();

        $guest->is_attending = 1;
        $guest->save();
        $name = $guest->name;
        event(new Attandance($name));
        return back();
    }

    private function transformEventDataForForm($event)
    {
        $formData = [
            'event' => [
                'bride_name'   => $event->bride_name,
                'groom_name'   => $event->groom_name,
                'wedding_date' => $event->wedding_date,
                'vanue'        => $event->vanue,
                'maps'         => $event->maps,
            ],
            'content_invitations' => [],
            'image_contents' => [],
            'gift' => [],
            'invitation' => []
        ];

        // Content Invitations
        if ($event->contentInvitations) {
            $formData['content_invitations'] = $event->contentInvitations->toArray();

            // Image Contents
            if ($event->contentInvitations->imageContents) {
                $formData['image_contents'] = $event->contentInvitations->imageContents
                    ->sortBy('sort')
                    ->map(function ($img) {
                        return
                            [
                                'id'   => $img->id,
                                'name' => $img->name,
                                'url'  => getImageCompressUrl($img['file']['mimetype'], $img['file']['compressed_name']),
                                'sort' => $img->sort,
                            ];
                    })
                    ->toArray();
            }

            // Gift
            if ($event->contentInvitations->gift) {
                $formData['gift'] = $event->contentInvitations->gift
                    ->map(function ($gift) {
                        return [
                            'bank_id'       => $gift->bank_id,
                            'receiver_name' => $gift->receiver_name,
                            'no_req'        => $gift->no_req,
                        ];
                    })
                    ->toArray();
            }
        }

        // Invitation
        if ($event->invitation) {
            $formData['invitation'] = $event->invitation->toArray();
        }
        if ($event->eventschedule) {
            $formData['schedules'] = $event->eventschedule->toArray();
        }

        return $formData;
    }


    private function getTemplates()
    {
        return Template::get();
    }
    private function getBankAccounts()
    {
        return Bank::get();
    }

    public function invitation($eventId)
    {
        $event = Event::findOrFail($eventId);
        $this->model = new Invitation();
        $this->segmentName = 'invitations';
        $this->table_name = 'invitations';
        $this->forms = $this->model->getForms();
        $this->reference = $this->model->getReference();
        $newForms = [];
        foreach ($this->forms as $key => $value) {
            if($value['name']==='wedding_id'){
                $value['value'] = $event;
                $newForms[$key] = $value;
                continue;
            }
            if (isset($model[$value['name']])) {
                $value['value'] = $model[$value['name']];
            } else {
                $value['value'] = null;
            }
            $newForms[$key] = $value;
        }
        // dd($newForms);
        $this->view = view('backend.invitation.create', ['forms' => $this->forms]);
        return $this->view->with(
            [
                'forms' => $newForms,
                'segmentName' => $this->segmentName,
                'event' => $event,
            ]
        );
    }

    public function import(Request $request, $eventId)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);
        Excel::import(new InvitationImport($eventId), $request->file('file'));

        return back()->with('success', 'Daftar tamu berhasil diimport.');
    }

}
