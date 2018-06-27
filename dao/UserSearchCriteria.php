<?php
final class UserSearchCriteria {
    private $login = null;
    public function getLogin() {
        return $this->login;
    }
    public function setLogin($login) {
        $this->login = $login;
        return $this;
    }
}