<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();

        foreach (Route::getRoutes()->getRoutes() as $route) {
            $action_object = $route->getAction();

            if (!empty($action_object['controller'])) {
                $controller = explode('Controllers\\', $action_object['controller'])[1];

                $controller_split = explode('@', $controller);
                $controller = $controller_split[0];
                $action = $controller_split[1];
                $object = str_replace('Controller', '', $controller);

                if (strpos(strtolower($object), 'auth') === false && !in_array($action, ['store', 'update'])) {
                    Permission::create([
                        'object' => $object,
                        'action' => $action,
                    ]);
                }
            }
        }
    }
}
