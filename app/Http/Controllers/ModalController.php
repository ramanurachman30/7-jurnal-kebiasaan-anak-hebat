<?php

namespace App\Http\Controllers;

use App\Models\Resources;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModalController extends Controller
{
    protected $model = null;
    protected $forms;
    protected $view;
    protected $segment;

    public function __construct(Request $request, Resources $model)
    {
        $this->segment = $request->segment(3);
        if (file_exists(app_path('Models/' . Str::studly($this->segment)) . '.php')) {
            $this->model = app("App\Models\\" . Str::studly($this->segment));
        } else {
            if ($model->checkTableExists($this->segment)) {
                $this->model = $model;
                $this->model->setTable($this->segment);
            }
        }

        if (!$this->model) abort(404);
        $this->forms = $this->model->getForms();
    }

    public function investmentSector(Request $request)
    {
        $this->view = view('backend.modal.investment_sector');
        return $this->view->with(
            [
                'forms' => $this->forms
            ]
        );
    }

    public function subInvestmentOutlooks(Request $request)
    {
        $this->view = view('backend.modal.sub_investment_outlooks');
        return $this->view->with(
            [
                'forms' => $this->forms
            ]
        );
    }

    public function iipcReasons(Request $request)
    {
        $this->view = view('backend.modal.iipc_reasons');
        return $this->view->with(
            [
                'forms' => $this->forms
            ]
        );
    }

    public function subOrganizations(Request $request)
    {
        $forms = $this->forms;
        $modalForm = 'modalForm';
        if (count($request->all()) > 0) {
            $data = $request->all();
            $newForms = [];
            foreach ($this->forms as $key => $value) {
                if (isset($data[$value['name']])) {
                    $value['value'] = $data[$value['name']];
                } else {
                    $value['value'] = null;
                }
                $newForms[$key] = $value;
            }

            $forms = $newForms;
            $modalForm = 'updateForm';
        }

        $this->view = view('backend.modal.sub_organizations');
        return $this->view->with(
            [
                'forms' => $forms,
                'modalForm' => $modalForm
            ]
        );
    }

    public function galleries(Request $request)
    {
        $this->view = view('backend.modal.galleries');
        return $this->view->with(
            [
                'forms' => $this->forms
            ]
        );
    }
}
