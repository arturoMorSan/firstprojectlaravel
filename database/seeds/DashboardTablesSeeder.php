<?php

use App\Permission;

class DashboardTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncate(['dashboard_sections', 'dashboard_submenus', 'dashboard_links']);

        $permissions = Permission::all('id', 'key_name')->pluck('id', 'key_name');

        foreach ($this->getData() as $i => $section) {
            $sectionId = DB::table('dashboard_sections')->insertGetId([
                'name'       => $section['name'],
                'tile'       => $section['tile'],
                'order'      => $i + 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            foreach ($section['submenus'] as $j => $submenu) {
                $submenuId = DB::table('dashboard_submenus')->insertGetId([
                    'name'       => $submenu['name'],
                    'icon'       => $submenu['icon'],
                    'order'      => $j + 1,
                    'section_id' => $sectionId,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                foreach ($submenu['links'] as $k => $link) {
                    DB::table('dashboard_links')->insert([
                        'name'          => $link['name'],
                        'route'         => $link['route'],
                        'order'         => $k + 1,
                        'submenu_id'    => $submenuId,
                        'permission_id' => $permissions[$link['permission']],
                        'created_at'    => date('Y-m-d H:i:s'),
                        'updated_at'    => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }
    }



    /**
     * Return the data to populate tables.
     *
     * @return array
     */
    private function getData()
    {
        return [
            [
                'name' => 'Participantes',
                'tile' => 'publications.png',
                'submenus' => [
                    [
                        'name' => 'Participantes',
                        'icon' => 'seminar.png',
                        'links' => [
                            [
                                'name'       => 'Lista de ponentes',
                                'route'      => 'ponentes',
                                'permission' => 'view.project'
                            ],
                            [
                                'name'       => 'Lista de participantes',
                                'route'      => 'participantes',
                                'permission' => 'view.project'
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Convocatorias',
                'tile' => 'comment.png',
                'submenus' => [
                    [
                        'name' => 'Tipos de convocatorias',
                        'icon' => 'file.png',
                        'links' => [
                            [
                                'name'       => 'Lista de tipos de convocatorias',
                                'route'      => 'tipos-convocatorias',
                                'permission' => 'view.calltype'
                            ],
                            [
                                'name'       => 'Agregar tipo de archivo',
                                'route'      => 'tipos-convocatorias/crear',
                                'permission' => 'create.calltype'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Convocatorias',
                        'icon' => 'comment.png',
                        'links' => [
                            [
                                'name'       => 'Lista de convocatorias',
                                'route'      => 'convocatorias',
                                'permission' => 'view.calls'
                            ],
                            [
                                'name'       => 'Agregar Convocatorias',
                                'route'      => 'convocatorias/crear',
                                'permission' => 'create.calls'
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Usuarios',
                'tile' => 'users.png',
                'submenus' => [
                    [
                        'name' => 'Usuarios',
                        'icon' => 'users.png',
                        'links' => [
                            [
                                'name'       => 'Lista de Usuarios',
                                'route'      => 'usuarios',
                                'permission' => 'view.users'
                            ],
                            [
                                'name'       => 'Agregar usuario',
                                'route'      => 'usuarios/crear',
                                'permission' => 'create.users'
                            ]
                        ]
                    ],
                ]
            ],

        ];
    }
}

