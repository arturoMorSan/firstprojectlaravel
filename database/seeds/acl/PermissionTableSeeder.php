<?php

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncate(['permissions']);

        foreach ($this->getData() as $keyName => $name) {
            DB::table('permissions')->insert([
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
             /*
             * Profile
             */
            'update.password' => 'Cambiar contraseña',
            /*
             * Project
             */
            'review.project' => 'Acceso a evaluar proyectos',
            'view.project' => 'Ver proyecto',
            /*
             * Users
             */
            'view.users' => 'Ver Usuarios',
            'create.users' => 'Agregar usuarios',
            /*
            *  tipos de archivos
             */
            'view.calltype' => 'Ver tipos de convocatorias',
            'create.calltype' => 'Agregar tipo de convocatoria',

            /*
             * Convocatorias
             */

            'view.calls' => 'Ver convocatorias',
            'create.calls' => 'Agregar convocatoria',


        ];
    }
}
