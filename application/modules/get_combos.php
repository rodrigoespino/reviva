<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing extends Admin_Controller {

    public function __construct(){
        parent::__construct();
        $this->ads = '';
        $this->ads = $this->ads_model->get_ads();
    }
    
    public function index()
    {
        //Cuidad
      //  $data =['clients'] = $this->loadCombos->get_all_clients();

      //  $data['country_res'] = $this->countries_model->get_all_countries();
    
        $this->load->view('home_view',$data);
    }
    
    public function get_cities(){
    
            $options = "";
            if ($this->input->post('id_country')) {
                $id_country = $this->input->post('id_country');
                $cities_res = $this->cities_model->get_all_cities($id_country);
                foreach ($cities_res as $fila) {
                    ?>
                    <option value="<?php echo $fila->id ?>"><?php echo $city_name ?></option>
                    <?php
                }
            }
    }

}