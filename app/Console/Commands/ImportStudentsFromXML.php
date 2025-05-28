<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;

class ImportStudentsFromXML extends Command
{
    /**
     * The name and signature of the console command.clear
     *
     * @var string
     */
    protected $signature = 'app:import-students-from-xml';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importar datos de estudiantes desde un archivo XML';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = storage_path('app/pr.xml');

        if (!file_exists($path)) {
            $this->error('El archivo XML no existe en la ruta especificada.');
            return 1;
        }

        $xml = simplexml_load_file($path);

        foreach ($xml->student as $studentData) {
            Student::updateOrCreate(
                [
                    'name' => (string)$studentData->name,
                    'lastname' => (string)$studentData->lastname,
                    'email' => (string)$studentData->email,
                    'disability'=> filter_var ($studentData->disability, FILTER_VALIDATE_BOOLEAN),
                    'address' => (string)$studentData->address,
                    'idcard' => (string)$studentData->idcard,
                    'birthday' => fake()->dateTimeBetween('-50 years', '-16 years')->format('d-m-Y'),
                ]
            );
        }
    }
}
