<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	/**
	 * [$where variable para hacer los filtros de coincidencia exacta]
	 * @var array
	 */
	protected $where = [];
	/**
	 * [$like filtros para encontrar un patron de texto dentro de las columnas]
	 * @var array
	 */
	protected $like = [];

	protected $ASSETS;
   	protected $UPLOADS;

	function __construct() {
		parent::__construct();
		date_default_timezone_set('America/Mexico_City');
		/**
		 * [$menus contendra todos los menus de primer nivel como indice
		 *  y todos los submenus como valores]
		 * @var array
		 */
		$menus = array();
		/**
		 * [$menu_tercernivel alamcena los valores en relacion solo
		 * de los menus  de segundo nivel  que tienen un tercel nivel]
		 * @var array
		 */
		$menu_tercernivel = array();
		/**
		 * [$submenus este array es temporal y siver para ir guardando los
		 * submenus que tiene cada menu para evitar repetirlos]
		 * @var array
		 */
		$data['vistas'] = $menus;
		$data['menu_lvtres'] = $menu_tercernivel;

		//Asignamos el valor a las variables
		$this->ASSETS = "./assets/";
   		$this->UPLOADS = "uploads/";

		/**
		 * cargamos las variables a todas las vistas
		 */
		$this->load->vars($data);
		$this->header = "structure/header";
		$this->menu = 'structure/menu';
		$this->notifications = 'structure/notifications';
		$this->footer = "structure/footer";
		$this->folder = 'structure';
	}

	/*
	 * Función que arma automáticamente la vista de un módulo cada vez que se invoca,
	 * al invocarse; obtiene la cabecera, el footer, el menú y la vista de notificaciones
	 * la parte de los datos la consulta tomando en cuenta el primer parámentro que es
	 * el nombre de dicha vista, el segunto parámetro es un arreglo con todos los datos que va a mostrar.
	 */

	public function esqueleto($view, $data = NULL) {

		$this->load->view($this->header, $data);
		$this->load->view($this->menu, $data);
		$this->load->view($this->notifications, $data);
		$this->load->view($view, $data);
		$this->load->view($this->footer);
	}

	/*
	 * Función que obtiene los datos en una consulta de la base de datos.
	 * Obtiene como parámetros por post: las columnas de la tabla y el nombre de la tabla
	 */

	public function getData($modulo = NULL) {
		if (!$modulo) {
			$dato['param'] = $this->input->post('param');
			$dato['table'] = $this->input->post('table');

			$this->datatables->select($dato['param'])
				->from($dato['table'])
				->where('lbaja', 1);
			echo $this->datatables
				->generate();
		} else {
			$dato['param'] = $this->input->post('param');
			$dato['table'] = $this->input->post('table');

			$this->datatables->select($dato['param'])
				->from($dato['table'])
				->where('tipo', $modulo)
				->where('lbaja', 1);
			echo $this->datatables
				->generate();
		}
	}

	/*
	 * Función que obtiene como parámetros el nombre de una tabla y el id de un campo y reliza
	 * un movimiento de la base de datos que da de baja el campo del id recibido
	 */

	function baja_objeto($table, $id_objeto) {
		$dato['id_objeto'] = $this->input->post('id_objeto');
		$dato['table'] = $this->input->post('table');
	}
	/**
	 * [add_where pensado para crear un array con parametros  que se pueda
	 * usar en MY model]
	 * @param [string] $name_post   [nombre de la variable que viene via post]
	 * @param [string] $name_column [nombre  de la columna de la tabla]
	 * @author Manuel MT <manuel@canteradigital.mx>
	 * fecha: 16-did-2105
	 */
	protected function add_where($name_post, $name_column, $tipo = "POST"){
		if ($tipo == "POST") {
			$parametro = $this->input->get_post($name_post);
		} else {
			$parametro = $this->input->get($name_post);
		}

		if ($parametro) {
			$this->where[$name_column] = $parametro;
		}
	}

	/**
	 * [add_where pensado para crear un array con parametros  que se pueda
	 * usar en MY model en la funcion  like]
	 * @param [string] $name_post   [nombre de la variable que viene via post]
	 * @param [string] $name_column [nombre  de la columna de la tabla]
	 * @author Manuel MT <manuel@canteradigital.mx>
	 * fecha: 16-did-2105
	 */
	protected function add_like($name_post, $name_column){
		$parametro = $this->input->get_post($name_post);
		if ($parametro) {
			$this->like[$name_column] = $parametro;
		}
	}

	/**
     * Función para crear el folder para almacenae el PDF temporal
     * Asignamos los permisos para poder escribir
     * @param [cadena] [nombre_folder] [Para almacenamiento temporal]
     * @return [cadena] [Ruta del folder creado]
     * @author [Kuko] => [refugio@canteradigital.mx]
     * Fecha 22/09/2016
     */
    public function createFolder($folder){
    	$base = $this->ASSETS.$this->UPLOADS;
    	$ruta = $this->ASSETS.$this->UPLOADS.$folder."/";
    	if(!is_dir($ruta)){
        	mkdir($this->ASSETS, 0777);
        	mkdir($base, 0777);
           	mkdir($ruta, 0777);
        }
        return $ruta;
    }

	/**
     * Función para crear el folder para almacenae el PDF temporal
     * @param [cadena] [nombre_folder] => Es el nombre del folder creado en la función {createFolder($folder)}
     * @param [cadena] [nombre_archivo] => Es el archivo que se almacena dentro del folder
     * @return El PDF visible en el navegador
     * @author [Kuko] => [refugio@canteradigital.mx]
     * Fecha 22/09/2016
     */
    public function showFile($folder, $name){
    	$base = $this->ASSETS.$this->UPLOADS;
    	$directorio = $this->ASSETS.$this->UPLOADS.$folder;
    	if(is_dir($directorio)){
	        $filename = $name.".pdf";
            $ruta = base_url($directorio."/".$filename);
            if(file_exists($directorio."/".$filename)){
                header('Content-type:application/pdf');
                readfile($ruta);
            }
        }
    }

	/**
     * Función para descargar el PDF del navegador
     * @param [cadena] [nombre_folder] => Es el nombre del folder creado en la función {createFolder($folder)}
     * @param [cadena] [nombre_archivo] => Es el archivo que se almacena dentro del folder
     * @author [Kuko] => [refugio@canteradigital.mx]
     * Fecha 22/09/2016
     */
    public function downloadPdf($folder, $name){
    	$directorio = $this->ASSETS.$this->UPLOADS.$folder;
        if(is_dir($directorio)){
	        $filename = $name.".pdf";
        	$ruta = base_url($directorio."/".$filename);
            if(file_exists($directorio."/".$filename)){
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header('Content-disposition: attachment; filename='.basename($ruta));
                header("Content-Type: application/pdf");
                header("Content-Transfer-Encoding: binary");
                header('Content-Length: '. filesize($ruta));
                readfile($ruta);
            }
        }
    }
    public function responseJson($responseJson){
		header("Content-Type: application/json;charset=utf-8");
		echo json_encode($responseJson);
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
