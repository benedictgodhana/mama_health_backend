<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // 1. Ensure roles exist with 'web' guard
        $roles = ['admin', 'health_worker', 'mother'];
        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'web',
            ]);
        }

        // Helper function to create user if not exists
        $createUser = function ($data, $roleName) {
            $user = User::where('id_number', $data['id_number'])
                        ->orWhere('email', $data['email'])
                        ->first();

            if (!$user) {
                $user = User::create([
                    'id_number' => $data['id_number'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'password' => bcrypt($data['password']),
                    'pin' => $data['pin'],
                    'gender' => $data['gender'],
                    'id_type' => $data['id_type'],
                    'phone_verified_at' => now(),
                ]);

                // Fetch the role for 'web' guard and assign
                $role = Role::where('name', $roleName)
                            ->where('guard_name', 'web')
                            ->first();

                if ($role) {
                    $user->syncRoles([$role]);
                }
            }
        };

        // 2. Seed users
        $users = [
            [
                'data' => [
                    'id_number' => 10000001,
                    'name' => 'Admin User',
                    'email' => 'admin@example.com',
                    'phone' => '08000000001',
                    'password' => 'password',
                    'pin' => '1234',
                    'gender' => 'other',
                    'id_type' => 'national_id',
                ],
                'role' => 'admin',
            ],
            [
                'data' => [
                    'id_number' => 20000001,
                    'name' => 'Health Worker',
                    'email' => 'worker@example.com',
                    'phone' => '08000000002',
                    'password' => 'password',
                    'pin' => '5678',
                    'gender' => 'female',
                    'id_type' => 'staff_id',
                ],
                'role' => 'health_worker',
            ],
            [
                'data' => [
                    'id_number' => 30000001,
                    'name' => 'Mother User',
                    'email' => 'mother@example.com',
                    'phone' => '08000000003',
                    'password' => 'password',
                    'pin' => '4321',
                    'gender' => 'female',
                    'id_type' => 'national_id',
                ],
                'role' => 'mother',
            ],
            // Additional mothers
            [
                'data' => [
                    'id_number' => 30000002,
                    'name' => 'Wanjiku Mwangi',
                    'email' => 'wanjiku.mwangi@example.com',
                    'phone' => '0712345678',
                    'password' => 'password',
                    'pin' => '9012',
                    'gender' => 'female',
                    'id_type' => 'national_id',
                ],
                'role' => 'mother',
            ],
            [
                'data' => [
                    'id_number' => 30000003,
                    'name' => 'Akinyi Otieno',
                    'email' => 'akinyi.otieno@example.com',
                    'phone' => '0723456789',
                    'password' => 'password',
                    'pin' => '3456',
                    'gender' => 'female',
                    'id_type' => 'national_id',
                ],
                'role' => 'mother',
            ],
            [
                'data' => [
                    'id_number' => 30000004,
                    'name' => 'Mumbi Njoroge',
                    'email' => 'mumbi.njoroge@example.com',
                    'phone' => '0734567890',
                    'password' => 'password',
                    'pin' => '7890',
                    'gender' => 'female',
                    'id_type' => 'national_id',
                ],
                'role' => 'mother',
            ],
            [
                'data' => [
                    'id_number' => 30000005,
                    'name' => 'Syombua Mutua',
                    'email' => 'syombua.mutua@example.com',
                    'phone' => '0745678901',
                    'password' => 'password',
                    'pin' => '1235',
                    'gender' => 'female',
                    'id_type' => 'national_id',
                ],
                'role' => 'mother',
            ],
            [
                'data' => [
                    'id_number' => 30000006,
                    'name' => 'Fatuma Hassan',
                    'email' => 'fatuma.hassan@example.com',
                    'phone' => '0756789012',
                    'password' => 'password',
                    'pin' => '5670',
                    'gender' => 'female',
                    'id_type' => 'national_id',
                ],
                'role' => 'mother',
            ],
        ];

        foreach ($users as $item) {
            $createUser($item['data'], $item['role']);
        }
    }
}
