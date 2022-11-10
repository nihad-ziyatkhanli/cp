<?php

namespace App\Http\Livewire\Widgets;

use Livewire\Component;
use App\Custom\General\Proxy;

class SelectMultiple extends Component
{
    /* Example:
    $config = [
        'name' => 'roleIds',
        'text' => 'title',
        'values_init' => $this->roleIds,
        'models' => null,
        'callback' => [\App\Models\Role::class, 'query'],
        'params' => [],
    ]
    */
    public $config;
    public Proxy $conf;
    public $rpp = 15;
    public $numOfRecords = 10;
    public $search;
    public $values;

    protected function getListeners()
    {
        return [$this->conf->name => 'handle'];
    }

    public function handle($config)
    {
        $this->conf = new Proxy($config);
        $this->values = $this->conf->values_init ?? [];
        $this->reset('numOfRecords');
        $this->emitUp('selected', [$this->conf->name, array_values($this->values)]);
    }

    public function mount()
    {
        $this->conf = new Proxy($this->config);
        $this->values = $this->conf->values_init ?? [];
    }

    public function getDropdownProperty()
    {
        if (isset($this->conf->models)) {
            /* Livewire couldn't hydrate collections and models properly, so we manually convert. */
            $models = is_array($this->conf->models) ? collect($this->conf->models)->map(function ($model) {
                return (object) $model;
            }) : $this->conf->models;

            /* Prepare dropdown: load from collection */
            $filtered = $models->filter(function($item) {
                return stripos($item->{$this->conf->text}, $this->search) !== false;
            });

            $options = $filtered->take($this->numOfRecords);
            $hasMore = $filtered->count() > $this->numOfRecords;
            $selected = $models->whereIn('id', $this->values);
        } else {
            /* Prepare dropdown: load from database */
            $query = call_user_func($this->conf->callback, ...$this->conf->params)->where($this->conf->text, 'like', '%'.$this->search.'%');

            $options = $query->take($this->numOfRecords)->get();
            $hasMore = $query->count() > $this->numOfRecords;
            $selected = call_user_func($this->conf->callback, ...$this->conf->params)->whereIn('id', $this->values)->get();
        }

        return compact('options', 'hasMore', 'selected');
    }

    public function increment()
    {
        $this->numOfRecords += $this->rpp;
    }

    public function toggle($id)
    {
        $key = array_search($id, $this->values);

        if ($key === false) {
            array_push($this->values, $id);
        }
        else {
            unset($this->values[$key]);
        }

        $this->emitUp('selected', [$this->conf->name, array_values($this->values)]);
    }

    public function render()
    {
        return view('cp.widgets.select-multiple');
    }
}
