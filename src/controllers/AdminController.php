<?php   namespace VerticalHorizon\ReactiveAdmin;

use VerticalHorizon\ReactiveAdmin\AdminBaseController as Controller;

class AdminController extends Controller {

    private $model_config_path;

    protected $modelName;
    protected $viewsPath;
    protected $uriSegment;
    protected $resourceId;

    public function __construct()
    {
        //$this->beforeFilter(function(){  });

        $this->model_config_path = app('path') . '/config/reactiveadmin';

        $this->uriSegment = null;
        $this->modelName = null;
        $this->viewsPath = null;
        $this->resourceId = null;

        if(\Route::input('alias') !== null)
        {
            $this->uriSegment = \Route::input('alias');
            $this->viewsPath = \File::exists(app_path('views/'.\Config::get('reactiveadmin::uri').'/'.$this->uriSegment)) ? \Config::get('reactiveadmin::uri').'.'.$this->uriSegment : 'reactiveadmin::default';
            $this->modelName = studly_case(str_singular(\Route::input('alias')));
            if(\Route::input('id') !== null)
            {
                $this->resourceId = \Route::input('id');
            }

            \View::share('config', require($this->model_config_path.'/'.$this->modelName.'.php'));


            // TODO: refactor this!
            // custome behavior
            switch ($this->uriSegment) {
                case 'settings':
                    View::composer(array('admin.'.$this->viewsPath.'.index'), function($view)
                    {
                        $view->with('settings', Settings::all());
                    });
                    break;

                default:
                    # code...
                    break;
            }

        }

        \View::share('view', $this->uriSegment);
        \View::share('model', $this->modelName);

    }

    /**
     * Display a listing of admins
     *
     * @return Response
     */
    public function index()
    {
        if($this->modelName)
        {
            if(\Input::has('sorting'))
            {
                $row = call_user_func($this->modelName.'::findOrFail', (int)Input::get('id'));
                $row->fill(array('sorting' => (int)Input::get('sorting')));
                method_exists($row, 'updateUniques') ? $row->updateUniques() : $row->save();
                return Response::make('OK', 200);
            }

            if($filter = \Input::get('filter'))
            {
                if(isset($filter['category.title']))
                    $rows = call_user_func($this->modelName.'::getByCategory', Category::where('alias', $filter['category.title'])->firstOrFail());
            }
            else
            {
                if(isset($this->orderBy)) {
                    $obj = new $this->modelName();
                    $rows = $obj::orderBy($this->orderBy[0], $this->orderBy[1])->paginate(20);
                }
                else {
                    // TODO: check if exists, validate: Eloquent/Ardent/Custom
                    $obj = new $this->modelName();
                    $rows = method_exists($obj, 'withTrashed') ? $obj::withTrashed()->paginate(20) : $obj::paginate(20);
                }

            }

            return \View::make($this->viewsPath.'.index')
                ->with('rows',  $rows);
        }
        else
        {        
            return \View::make('reactiveadmin::dashboard');
        }
    }

    /**
     * Show the form for creating a new admin
     *
     * @return Response
     */
    public function create()
    {
        return \View::make('admins.create');
    }

    /**
     * Store a newly created admin in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make($data = Input::all(), Admin::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        Admin::create($data);

        return Redirect::route('admins.index');
    }

    /**
     * Display the specified admin.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $admin = Admin::findOrFail($id);

        return \View::make('admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified admin.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $obj = new $this->modelName();
        $row = method_exists($obj, 'withTrashed') ? 
            $obj::withTrashed()->findOrFail((int)$this->resourceId)
            :
            $obj::findOrFail((int)$this->resourceId);

        return \View::make($this->viewsPath.'.edit')
            ->with('row', $row);
    }

    /**
     * Update the specified admin in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $obj = new $this->modelName();
        method_exists($obj, 'withTrashed') ? 
            $obj::withTrashed()->findOrFail((int)$this->resourceId)
            :
            $obj::findOrFail((int)$this->resourceId);

        $obj->fill( array_filter(\Input::all(), function($v){ return $v !== null;}) );
        
        // Note that all models we must extend from Ardent!
        if (method_exists($obj, 'updateUniques') ? $obj->updateUniques() : $obj->save()) {
            return \Redirect::to('admin/'.$this->uriSegment)
            ->with('info', $this->modelName.' <strong>'.$obj->title.'</strong> successfully updated!');
        } else {
            return \Redirect::to('admin/'.$this->uriSegment.'/'.$this->resourceId.'/edit')->withErrors($obj->errors());
        }
    }

    /**
     * Remove the specified admin from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $obj = new $this->modelName();
        method_exists($obj, 'forceDelete') ? 
            $obj::withTrashed()->findOrFail((int)$this->resourceId)->forceDelete()
            :
            $obj::findOrFail((int)$this->resourceId)->delete();

        return \Redirect::to(\Config::get('reactiveadmin::uri').'/'.$this->uriSegment)
           ->with('info', $this->modelName.' #<strong>'.$this->resourceId.'</strong> successfully deleted!');
    }

    /**
     * Move the specified row to trash.
     *
     * @param  int  $id
     * @return Response
     */
    public function trash($id)
    {
        call_user_func($this->modelName.'::destroy', $this->resourceId);
        return \Redirect::to(\Config::get('reactiveadmin::uri').'/'.$this->uriSegment)
           ->with('info', $this->modelName.' #<strong>'.$this->resourceId.'</strong> successfully trashed!');
    }

    /**
     * Restore the specified row from trash.
     *
     * @param  int  $id
     * @return Response
     */
    public function restore($id)
    {
        $obj = new $this->modelName();
        $obj::withTrashed()->findOrFail((int)$this->resourceId)->restore();

        method_exists($obj, 'updateUniques') ? $obj->updateUniques() : $obj->save();
        return \Redirect::to(\Config::get('reactiveadmin::uri').'/'.$this->uriSegment)
           ->with('info', $this->modelName.' #<strong>'.$this->resourceId.'</strong> successfully restored!');
    }
}
