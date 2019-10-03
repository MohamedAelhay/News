<?php

namespace App\Http\Controllers;

use App\Staff;
use App\Visitor;
use Illuminate\Support\Facades\Route;

class ToggleController extends Controller
{
    protected $table;
    protected $object;
    protected $instance;
    protected $model_name;
    protected const MODELS = [
        "staff" => Staff::class,
        "visitors" => Visitor::class,
    ];

    public function __construct()
    {
        $id = Route::current()->parameter('id');
        $this->getTableName()
             ->getModelName()
             ->getInstance()
             ->getObject($id);
    }

    public function toggleStatus($id)
    {
        $this->object->updateStatus();
    }

    protected function getTableName()
    {
        $this->table = explode("/", url()->previous())[3];
        return $this;
    }

    protected function getModelName()
    {
        $this->model_name = ToggleController::MODELS[$this->table];
        return $this;
    }

    protected function getInstance()
    {
        $this->instance = app($this->model_name);
        return $this;
    }

    protected function getObject($id)
    {
        $this->object = $this->instance->findOrFail($id);
    }
}
