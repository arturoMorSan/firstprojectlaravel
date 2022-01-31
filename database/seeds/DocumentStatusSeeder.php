<?php

class DocumentStatusSeeder extends Seeder
{
    
    
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncate(['document_statuses']);
        
        foreach ($this->getData() as $keyName => $name) {
            DB::table('document_statuses')->insert([
                'key_name'   => $keyName,
                'name'       => $name,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }


    /**
     * Return the data to populate table.
     *
     * @return array
     */
    private function getData()
    {
        return [
            'new'  => 'Recibido',
            'approved'  => 'Aprobado',
            'rejected'  => 'Rechazado',
        ];
    }
}
