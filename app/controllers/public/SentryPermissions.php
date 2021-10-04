<?php

class SentryPermissions extends BaseController{
    
    function run(){

        //clean the group db first

        DB::table('groups')->truncate();

        $permission = Config::get('sentry_permissions');

        foreach ($permission as $key => $value) {

            $name = $key;
            $permissions = (array) $value;

            $group = Sentry::createGroup(array(
                'name'        => $name,
                'permissions' => $permissions,
            ));

        }

        echo "Permissions has been successfully set.";

    }

    /*
     * For Temporary
     * creating admin
     * user for testing
     */

    function getRegister(){

        $user = Sentry::register(array(
            'email'    => 'letranjonel.gizmo@gmail.com',
            'password' => 'JLvirtual90',
        ));

        // Find the group using the group id
        $adminGroup = Sentry::findGroupById(1);

        // Assign the group to the user
        $user->addGroup($adminGroup);

    }

}

/* End of file SentryPermissions.php */
/* Location: ./app/controllers/SentryPermissions.php */
