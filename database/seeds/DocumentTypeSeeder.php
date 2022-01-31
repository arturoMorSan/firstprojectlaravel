<?php

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncate(['document_types']);
        
        foreach ($this->getData() as $keyName => $document) {
            DB::table('document_types')->insert([
                'key_name'   => $keyName,
                'name'       => $document['name'],
                'max_size'   => $document['max_size'],
                'mimes'      => $document['mimes'],
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
            'document' => [
                'name'     => 'Anteproyecto',
                'max_size' => '1 MB',
                'mimes'    => 'docx, doc',
            ],
        ];
    }
}
