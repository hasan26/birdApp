<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
    }


}

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");
        App\User::truncate();

        $passwordPlain = 'password';
        $password = Hash::make($passwordPlain);
        $userList = array(
            [
                'name' => 'admin',
                'email'=>'hasan@magento.id',
                'password'=>$password,
            ]
        );

        foreach ($userList as $user) {
            $userCreated = App\User::create($user);

            if ($userCreated)
                echo "Created User: {$userCreated->name}:{$passwordPlain}"."\n";
        }
    }
}
