<?php

class UserTableSeeder extends Seeder
{
   /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncate(['users']);

        foreach ($this->getData() as $email => $user) {
            DB::table('users')->insert([
                'email'      => $email,
                'name'       => $user['name'],
                'last_name'  => $user['last_name'],
                'password'   => bcrypt($user['password'] ?? 'test'),
                'role_id'    => $user['role_id'],
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

            'arturo.morales@ujed.mx' => [
                'name'      => 'Arturo',
                'last_name' => 'Morales',
                'password'  => 'Test1234',
                'role_id'   => 1
            ],
        ];
    }
}
