<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/
	 * 	- or -
	 * 		http://example.com/welcome/index
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            // get newest images from model
            $pix = $this->images->newest();
            
            //build an array of formatted cells for items
            foreach($pix as $picture){
                $cells[] = $this->parser->parse('_cell',(array) $picture,true);
            }
            
            //prime the table class
            $this->load->library('table');
            $parms = array(
                'table_open'=>'<table class="gallery">',
                'cell_start'=>'<td class="oneimage">',
                'cell_alt_start' => '<td class="oneimage">'
            );
            $this->table->set_template($parms);
            
            //generate table
            $rows = $this->table->make_columns($cell,3);
            $this->data['thetable'] = $this->table->generate($rows);
            
            $this->data['pagebody'] = 'gallery';
            $this->render();
        }
}
