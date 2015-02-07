<?php   namespace VerticalHorizon\ReactiveAdmin;

class ModelWrapper {
	private $className;
	private $object;

	//public static $config_path = app('path') . '/config/reactiveadmin';

	public function __construct($className = null)
	{
		if($className && class_exists($className))
		{
			$this->className = $className;
			$this->object = new $this->className();
			return $this->object;
		}
	}

	public function getConfig()
	{
		return require(app('path') . '/config/reactiveadmin/'.$this->className.'.php');
	}

	public function model($className = null)
	{
		if($className && class_exists($className))
		{
			$this->className = $className;
			$this->object = new $this->className();
		}
		return $this->object;
	}

    public function __call($name, $arguments)
    {
        if($this->hasMethod($name))
        	return $this->object->$name($arguments);
        else
        	return false;
    }

    /*public static function __callStatic($name, $arguments)
    {
        if($this->hasMethod($name))
        	return $this->model->$name($arguments);
        else
        	return false;
    }*/

	public function isArdent()
	{
		return is_a($this->object, 'LaravelBook\Ardent\Ardent');
	}

	public function isEloquent()
	{
		return is_a($this->object, 'Illuminate\Database\Eloquent\Model');
	}

	public function hasMethod($methodName = null)
	{
		return method_exists($this->object, $methodName);
	}

	public function methods()
	{
		return get_class_methods($this->object);
	}
}