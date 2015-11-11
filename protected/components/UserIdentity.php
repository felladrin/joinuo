<?php

class UserIdentity extends CUserIdentity
{

    private $_id;

    public function authenticate()
    {
        $record = User::model()->findByAttributes(array('username' => $this->username, 'active' => 1, 'banned' => 0)); // Looks for the username on User table.

        if ($record === null)
        {
            $record = User::model()->findByAttributes(array('email' => $this->username, 'active' => 1, 'banned' => 0)); // Looks for the email on User table if no username was found.
        }

        if ($record === null)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        else if (!Bcrypt::check($this->password, $record->password))
        {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }
        else
        {
            $this->_id = $record->id;
            $this->username = $record->username;
            $this->setState('level', $record->level->name);
            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }
    
    public function setId($id)
    {
        $this->_id = $id;
    }

}
