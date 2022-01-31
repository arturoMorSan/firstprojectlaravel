<?php

class CallTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncate(['call_types']);

        foreach ($this->getData() as $keyName => $name) {
            DB::table('call_types')->insert([
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
            'bachelor-thesis'     => 'Tesis de licenciatura/ingenieria',
            'research-projects'   => 'Proyectos de investigación',
            'research-clubs'      => 'Clubes de investigación',
        ];
    }
}
