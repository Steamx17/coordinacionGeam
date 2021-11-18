<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Coordinador']);
        $role3 = Role::create(['name' => 'Docente']);
        



        Permission::create(['name' => 'home','description'=>'Ver dashboard'])->syncRoles([$role1, $role2]);


        Permission::create(['name' => 'User.index','description'=>'Ver listado de usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'User.create','description'=>'Asignar roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'User.edit','description'=>'Editar usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'User.destroy','description'=>'Eliminar usuarios'])->syncRoles([$role1]);

        Permission::create(['name' => 'roles.index','description'=>'Ver listado de roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.create','description'=>'Crear roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.edit','description'=>'Editar roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.destroy','description'=>'Eliminar roles'])->syncRoles([$role1]);

        Permission::create(['name' => 'grupo.index','description'=>'Ver listado de grupos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'grupo.create','description'=>'Crear grupos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'grupo.edit','description'=>'Editar grupos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'grupo.destroy','description'=>'Eliminar grupos'])->syncRoles([$role1, $role2]);


        Permission::create(['name' => 'estudiante.index','description'=>'Ver listado de estudiantes'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'estudiante.create','description'=>'Crear estudiantes'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'estudiante.edit','description'=>'Editar estudiantes'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'estudiante.destroy','description'=>'Eliminar estudiantes'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'colegio.index','description'=>'Ver listados de instituciones'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'colegio.create','description'=>'crear institucion'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'colegio.edit','description'=>'Editar institucion'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'colegio.destroy','description'=>'Eliminar institucion'])->syncRoles([$role1, $role2]);

    
        Permission::create(['name' => 'subject.index','description'=>'Ver listado de asignaturas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'subject.create','description'=>'Crear una asignatura'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'subject.edit','description'=>'Editar asignatura'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'subject.destroy','description'=>'Eliminar asignatura'])->syncRoles([$role1, $role2]);


        Permission::create(['name' => 'docente.index','description'=>'Ver listado de docentes'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'docente.create','description'=>'Crear docente'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'docente.edit','description'=>'Editar docente'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'docente.destroy','description'=>'Eliminar docente'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'clase.index','description'=>'Ver listado de clases'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'clase.admin&&cordinador','description'=>'Ver listado de clase solo admin y coordinador'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'clase.docente','description'=>'Ver listado de clase solo docentes'])->syncRoles([$role3]);

        Permission::create(['name' => 'clase.create','description'=>'Asignar clases'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'clase.edit','description'=>'Editas clases'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'clasex.destroy','description'=>'Eliminar clases'])->syncRoles([$role1, $role2]);
        


    }
}
