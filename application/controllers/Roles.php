<?php
/**
 * Created by PhpStorm.
 * User: si-yang
 * Date: 2018-02-28
 * Time: 9:38 AM
 */

// Roles Controller
class Roles extends Application {

    public function actor($role = ROLE_GUEST) {
        $this->session->set_userdata('userrole', $role);
        redirect($_SERVER['HTTP_REFERER']); // back where we came from
    }
}