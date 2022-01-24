<?php

namespace App\Controller\Admin\Settings;

use App\Config\Config;
use App\Controller\Admin\AbstractAdminAction;
use App\Helper\AdminSession;
use App\Model\Repository\Administrator;
use App\Helper\Url as UrlHelper;

class Save extends AbstractAdminAction
{
    /**
     * @throws \Exception
     */
    public function execute()
    {
        $this->saveLogin();
        $this->saveThirdPartySettings();
        $this->saveDeveloperSettings();

        UrlHelper::redirect("/admin/settings");
    }

    protected function saveLogin()
    {
        $admin = AdminSession::getAdmin();
        try {
            if (isset($_POST['username'])) {
                if (AdminSession::getAdmin()->getUsername() != $_POST['username']
                    && Administrator::getAdministratorByUsername($_POST['username'])) {
                    throw new \Exception('Administrator with this username already exists');
                }
                $admin->setUsername($_POST['username']);
            }

            if (isset($_POST['password'])) {
                // TODO: check password strength (maybe?)
                if ($_POST['password']) {
                    $admin->setPassword($_POST['password']);
                }
            }

            if (Administrator::updateAdministrator($admin, $admin->getId())) {
                AdminSession::setAdmin($admin);
            }
        } catch (\Exception $e) {
            AdminSession::addErrorLog(new \Exception('Login: ', 0, $e));
        }
    }

    protected function saveThirdPartySettings()
    {
        try {
            if (isset($_POST['tiny_mce_api'])) {
                Config::set('tiny_mce/editor/api', $_POST['tiny_mce_api']);
            }
        } catch (\Exception $e) {
            AdminSession::addErrorLog(new \Exception('Admin: ', 0, $e));
        }
    }

    protected function saveDeveloperSettings()
    {
        try {
            Config::set('admin/settings/show_trace', isset($_POST['show_trace']) ? '1' : '0');
        } catch (\Exception $e) {
            AdminSession::addErrorLog(new \Exception('Developer: ', 0, $e));
        }
    }
}
