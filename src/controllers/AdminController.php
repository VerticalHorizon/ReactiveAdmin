<?php   namespace VerticalHorizon\ReactiveAdmin;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use VerticalHorizon\ReactiveAdmin\AdminBaseController as Controller;

class AdminController extends Controller {

    public $layout = 'reactiveadmin::root';

    protected $modelName;
    protected $viewsPath;
    protected $uriSegment;
    protected $resourceId;

    private $modelWrapper;

    public function __construct()
    {
        //$this->beforeFilter(function(){  });

        $this->uriSegment = null;
        $this->modelName = null;
        $this->viewsPath = null;
        $this->resourceId = null;

        if(Route::input('alias') !== null)
        {
            $this->uriSegment = Route::input('alias');
            $this->viewsPath = File::exists(app_path('views/'.Config::get('reactiveadmin::uri').'/'.$this->uriSegment))
                                ?
                                Config::get('reactiveadmin::uri').'.'.$this->uriSegment
                                :
                                'reactiveadmin::default';
            $this->modelName = studly_case(str_singular(Route::input('alias')));
            $this->modelWrapper = App::make('model_wrapper');
            $this->modelWrapper->model($this->modelName);

            if(Route::input('id') !== null)
            {
                $this->resourceId = Route::input('id');
            }

            View::share('config', $this->modelWrapper->getConfig());


            // TODO: refactor this!
            // custom behavior
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

        View::share('view', $this->uriSegment);
        View::share('model', $this->modelName);

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
            if(Input::has('sorting'))
            {
                $row = $this->modelWrapper->findOrFail((int)Input::get('id'));
                $row->fill(array('sorting' => (int)Input::get('sorting')));
                $this->modelWrapper->hasMethod('updateUniques') ? $row->updateUniques() : $row->save();
                return Response::make('OK', 200);
            }

            // FIXME:
            if($filter = Input::get('filter'))
            {
                if(isset($filter['category.title']))
                    $rows = $this->modelWrapper->getByCategory(Category::where('alias', $filter['category.title'])->firstOrFail());
            }
            else
            {
                // TODO: check if exists, validate: Eloquent/Ardent/Custom
                $obj = $this->modelWrapper->model();

                !$this->modelWrapper->hasMethod('withTrashed') ?: $obj = $obj::withTrashed();

                if($orderBy = Input::get('orderBy')) {
                    list($field, $dir) = array_divide($orderBy);
                    //$this->modelWrapper->orderBy($field[0],$dir[0]);
                    call_user_func_array(array($obj, "orderBy"), array($field[0], $dir[0]));
                }

                // normal or static call
                if(get_class($obj)===$this->modelName) {        // WTF???
                    if(method_exists($obj, 'paginate')) {
                        $rows = $this->modelWrapper->paginate(Config::get('reactiveadmin::rows_count'));
                    } else {
                        $rows = $this->modelWrapper->all();
                    }
                } else {
                    $rows = method_exists($obj, 'paginate')
                            ?
                            $obj->paginate(Config::get('reactiveadmin::rows_count'))
                            :
                            $obj->get();
                }

            }

            $this->layout->content = View::make($this->viewsPath.'.index')->with('rows',  $rows);
        }
        else
        {        
            $this->layout->content = View::make('reactiveadmin::dashboard');
        }
    }

    /**
     * Show the form for creating a new admin
     *
     * @return Response
     */
    public function create()
    {
        if(Request::ajax())
        {
            return View::make('reactiveadmin::partials.create_ajax')
                ->render();
        }
        else
        {
            $this->layout->content = View::make($this->viewsPath.'.create');
        }
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
        $obj = $this->modelWrapper->findOrFail($this->resourceId);

        return View::make($this->viewsPath.'.show', compact('obj'));
    }

    /**
     * Show the form for editing the specified admin.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $row = $this->modelWrapper->hasMethod('withTrashed') ? 
                $this->modelWrapper->withTrashed()->findOrFail((int)$this->resourceId)
                :
                $this->modelWrapper->findOrFail((int)$this->resourceId);

        if(Request::ajax())
        {
            return View::make('reactiveadmin::partials.edit_ajax')
                ->with('row', $row)
                ->render();
        }
        else
        {
            $this->layout->content = View::make($this->viewsPath.'.edit')->with('row', $row);
        }
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
        $obj = method_exists($obj, 'withTrashed') ? 
            $obj::withTrashed()->findOrFail((int)$this->resourceId)
            :
            $obj::findOrFail((int)$this->resourceId);

        $obj->fill( array_filter(Input::all(), function($v){ return $v !== null;}) );

        // Note that all models we must extend from Ardent!
        if (method_exists($obj, 'updateUniques') ? $obj->updateUniques() : $obj->save()) {
            return Redirect::to(Input::get('from', Config::get('reactiveadmin::uri').'/'.$this->uriSegment))
            ->with('info', \Lang::get('reactiveadmin::reactiveadmin.notifications.updated', array('object' => $this->modelName, 'title' => '<strong>'.$obj->title.'</strong>')));
        } else {
            return Redirect::to(Config::get('reactiveadmin::uri').'/'.$this->uriSegment.'/'.$this->resourceId.'/edit'.(Input::has('from')?'?from='.Input::get('from'):''))
                ->withErrors($obj->errors());
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

        return Redirect::back()
           ->with('info', \Lang::get('reactiveadmin::reactiveadmin.notifications.deleted', array('object' => $this->modelName, 'title' => '#<strong>'.$this->resourceId.'</strong>')));
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
        return Redirect::back()
           ->with('info', \Lang::get('reactiveadmin::reactiveadmin.notifications.trashed', array('object' => $this->modelName, 'title' => '#<strong>'.$this->resourceId.'</strong>')));
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

        return Redirect::back()
           ->with('info', \Lang::get('reactiveadmin::reactiveadmin.notifications.restored', array('object' => $this->modelName, 'title' => '#<strong>'.$this->resourceId.'</strong>')));
    }
}
