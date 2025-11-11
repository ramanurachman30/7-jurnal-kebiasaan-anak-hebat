<?php

namespace App\Http\Controllers;

use App\Models\PKMGrades;
use App\Models\PKMStudents;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PKMStudentsController extends AppController
{
    protected $table_name = null;
    protected $model;
    protected $forms;
    protected $segment;
    protected $view;
    protected $segmentName;
    protected $reference;

    public function __construct(Request $request, PKMStudents $model)
    {
        try {
            $this->segment = $request->segment(2);
            
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
        $grades = PKMGrades::get();
        $this->view = view('backend.students.list', [
            'forms' => $this->forms,
            'grades' => $grades,
        ]);
        return $this->view->with([
            'forms' => $this->forms,
            'segmentName' => $this->segmentName,
            'grades' => $grades
        ]);
    }
}
