<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            'ver-rol',
             'crear-rol',
             'editar-rol',
             'borrar-rol',

             'ver-deposito',
             'crear-deposito',
             'editar-deposito',
             'borrar-deposito',

             'ver-usuario',
             'crear-usuario',
             'editar-usuario',
             'borrar-usuario',


             'ver-alumna',
             'crear-alumna',
             'editar-alumna',
             'borrar-alumna',
         ];
         foreach($permisos as $permiso) {
             Permission::create(['name'=>$permiso]);
         }
    }
}
