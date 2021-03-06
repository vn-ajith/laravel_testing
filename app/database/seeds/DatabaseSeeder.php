<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//Eloquent::unguard();

		$this->call('FormConfigSeeder');
	}

}
class FormConfigSeeder extends Seeder
{
	public function run()
	{
		$form = [
            ['form_name' => 'contact form', 'form_url' => 'FormsController@savethis','field_num'=>4,'desc_order'=>'{SLT_1:{
						"label" : "label_1",
						"default" : "default value is nothing",
						"css class name" : "foo",
						"field_size": "medium",
						"required": 1}}']
            
        ];
 
        DB::table('form_configs')->insert($form);
	}
}