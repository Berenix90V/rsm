<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custompicker extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }
    public function picker()
	{
        $this->load->model('Custompicker_model');
        // pesco da file tablearray
		$path = 'json/pickerarray.php';
        $alltablearray = url_get_contents($path);
        $post = $_POST;
        //echo 'ciao';
        //iprint_r($post);
        $pickerfield = $post['name'];
        //echo $pickerfield;
        
        
        $queryarray = $alltablearray[$pickerfield];
        //iprint_r($queryarray);
        $result = $this->Custompicker_model->custompicker_query($post, $queryarray);
        //iprint_r($_POST);
        ?>

        <div id='tendina'>
        <table class="table">
        <tbody>
        <?php
       
        foreach($result as $key => $value){
            
            //iprint_r($value);
            echo '<tr class="tendinarow">';
            //iprint_r($value);
            foreach($value as $field=>$val){
                /*if(isset($queryarray['data-hidden']) && $field == $queryarray['data-hidden'] && $field == $queryarray['data-input']){
                    echo '<td class="toinput" style="display:none" name = "'.$queryarray['name'].'">'.$val.'</td>';
                }*/ 
                if(isset($queryarray['data-hidden']) && array_key_exists($field, $queryarray['data-hidden'])  && in_array($field, $queryarray['data-input'])){
                    echo '<td class="toinput" style="display:none" name = "'.$queryarray['data-hidden'][$field].'">'.$val.'</td>';
                }else{
                    if(in_array($field, $queryarray['data-input'])){
                        echo '<td class="toinput" name = "'.$field.'">'.$val.'</td>';
                    } elseif($field == $queryarray['data-inputshow']){
                        echo '<td class="show">'.$val.'</td>';
                    } elseif(isset($queryarray['data-havinghidden']) && in_array($field, $queryarray['data-havinghidden'])){
                        echo '<td  style="display:none">'.$val.'</td>';                    
                    } else{
                        echo '<td>'.$val.'</td>';
                    }
                }               
            }
            echo '</tr>';
        }

        ?>
        
        </tbody>
        </table>
        </div>

        <?php
		
    }
		
}