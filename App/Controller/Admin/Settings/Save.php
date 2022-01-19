<?php

namespace App\Controller\Admin\Settings;

use App\Config\Config;
use App\Controller\Admin\AbstractAdminAction;
use App\Helper\Url as UrlHelper;

class Save extends AbstractAdminAction
{
    /**
     * @throws \Exception
     */
    public function execute()
    {
        $this->saveUser();
        $this->saveThirdPartySettings();
        $this->saveDeveloperSettings();

        UrlHelper::redirect("/admin/settings");
    }

    protected function saveUser()
    {
        try {
            if (isset($_POST['username'])) {
                Config::set('admin/user/name', $_POST['username']);
            }

            if (isset($_POST['password'])) {
                // TODO: check password strength (maybe?)
                if ($_POST['password']) {
                    Config::set('admin/user/password', md5($_POST['password']));
                }
            }
        } catch (\Exception $e) {
            $_SESSION['error_log'][] = new \Exception('Admin: ', 0, $e);
        }
    }

    protected function saveThirdPartySettings()
    {
        try {
            if (isset($_POST['tiny_mce_api'])) {
                Config::set('tiny_mce/editor/api', $_POST['tiny_mce_api']);
            }
        } catch (\Exception $e) {
            $_SESSION['error_log'][] = new \Exception('Admin: ', 0, $e);
        }
    }

    protected function saveDeveloperSettings()
    {
        try {
            Config::set('admin/settings/show_trace', isset($_POST['show_trace']) ? '1' : '0');
        } catch (\Exception $e) {
            $_SESSION['error_log'][] = new \Exception('Developer: ', 0, $e);
        }
    }
}