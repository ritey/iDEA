<?php

namespace Idea\Commands;

use DB, Storage;
use Illuminate\Console\Command;

class GenerateModels extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'idea:generate_models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate simple model classes based off an existing table structure';
    
    private function template($table_data)
    {
        $html = "<?php\n";
		$html .= "\n";
		$html .= "namespace Idea\Models;\n";
		$html .= "\n";
		$html .= "use Idea\Traits\ScopeEnabled;\n";
		$html .= "use Illuminate\Database\Eloquent\Model;\n";
		$html .= "use Idea\Traits\SetEnabledAttribute;\n";
		$html .= "\n";
		$html .= "class " . $table_data['class'] . " extends Model\n";
		$html .= "{\n";
		$html .= "\tuse SetEnabledAttribute, ScopeEnabled;\n";
		$html .= "\n";
		$html .= "\t/**\n";
		$html .= "\t* The database connection used with the model.\n";
		$html .= "\t*\n";
		$html .= "\t* @var string\n";
		$html .= "\t*/\n";
		$html .= "\tprotected ".'$connection'." = 'mysql';\n";
		$html .= "\n";
		$html .= "\t/**\n";
		$html .= "\t* The table associated with the model.\n";
		$html .= "\t*\n";
		$html .= "\t* @var string\n";
		$html .= "\t*/\n";
		$html .= "\tprotected ".'$table'." = '".$table_data['tablename']."';\n";
		$html .= "\n";
		$html .= "\t/**\n";
		$html .= "\t* The attributes that should be hidden from arrays.\n";
		$html .= "\t*\n";
		$html .= "\t* @var array\n";
		$html .= "\t*/\n";
		$html .= "\tprotected ".'$hidden'." = [];\n";
		$html .= "\n";
		$html .= "\t/**\n";
		$html .= "\t* The default attributes.\n";
		$html .= "\t*\n";
		$html .= "\t* @var array\n";
	    $html .= "\t*/\n";
		$html .= "\tprotected ".'$attributes'." = [];\n";
		$html .= "\n";
		$html .= "\t/**\n";
		$html .= "\t* Carbon converted dates.\n";
		$html .= "\t*\n";
		$html .= "\t* @var array\n";
	    $html .= "\t*/\n";
		$html .= "\tprotected ".'$dates'." = [];\n";
		$html .= "\n";
		$html .= "\t/**\n";
		$html .= "\t* Enable eloquent timestamps.\n";
		$html .= "\t*\n";
		$html .= "\t* @var boolean\n";
	    $html .= "\t*/\n";
		$html .= "\tpublic ".'$timestamps'." = true;\n";
		$html .= "\n";
		$html .= "\t/**\n";
		$html .= "\t* The attributes that are mass assignable.\n";
		$html .= "\t*\n";
		$html .= "\t* @var array\n";
	    $html .= "\t*/\n";
		$html .= "\tprotected ".'$fillable'." = [\n";
	    foreach($table_data['fields'] as $field) {
            $html .= "\t\t'".$field."',\n";
        }
	    $html .= "\t];\n";
	    $html .= "}\n";
        return $html;
    }

	public function handle()
	{
        $tables = $table_names = [];
        $data = DB::select('SHOW TABLES FROM ' . config('database.connections.mysql.database'));
        if (is_array($data)) {
            foreach($data as $table) {
                $property = 'Tables_in_' . config('database.connections.mysql.database');
                $table_names[] = $table->$property;
                $columns = DB::select("SHOW COLUMNS FROM " . $table->$property . " IN " . config('database.connections.mysql.database'));
                if ( is_array($columns) ) {
                    $fields = [];
                    foreach($columns as $column) {
                        $fields[] = $column->Field;
                    }
                    $tables[$table->$property] = $fields;
                }
            }
            foreach ($tables as $tablename => $fields) {
                $class = str_replace(' ','',ucwords(str_replace('_',' ',$tablename)));
                $models[] = [
                    'class' => $class,
                    'file' => $this->template(['class' => $class, 'tablename' => $tablename, 'fields' => $fields]),
                ];
            }
            foreach($models as $model) {
                Storage::put('Models/'.$model['class'] . '.php', $model['file']);
            }
        }
    }
}