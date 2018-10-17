<?php

// Set default timezone
date_default_timezone_set('UTC');


/****************************************
 * Create database and tables           *
 ****************************************/
function CreateTables()
{
    try {

        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $file_db->exec("PRAGMA foreign_keys = ON");

        // Create table users
        $file_db->exec("CREATE TABLE IF NOT EXISTS users (
                    login TEXT PRIMARY KEY, 
                    password TEXT, 
                    valid INTEGER, 
                    role TEXT);");

        // Create table messages
        $file_db->exec("CREATE TABLE IF NOT EXISTS messages (
                    id INTEGER PRIMARY KEY, 
                    title TEXT, 
                    message TEXT, 
                    time TEXT);");

        $file_db->exec("CREATE TABLE IF NOT EXISTS messageSent (
                    sender TEXT, 
                    receiver TEXT,
                    idMessage INTEGER,
                    FOREIGN KEY (sender) REFERENCES users(login) ON DELETE CASCADE,
                    FOREIGN KEY (receiver) REFERENCES users(login) ON DELETE CASCADE,
                    FOREIGN KEY (idMessage) REFERENCES message(time) ON DELETE CASCADE);");

        // Close file db connection
        $file_db = null;

    } catch (PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
}

function ListMessage($user)
{
    try {
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $result = $file_db->query("SELECT * 
                                                  FROM  messages
                                                  INNER JOIN messageSent
                                                    ON messages.id = messageSent.idMessage
                                                  WHERE messageSent.sender LIKE '{$user}'
                                                  ORDER BY messages.time ASC;");

        return $result;

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
function ListUser()
{
    try {
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $result = $file_db->query("SELECT login, valid, role FROM users");

        return $result;

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
function SendMessage($from, $to, $id, $title, $message, $time)
{
    try {
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $formatted_time = date('Y-m-d H:i:s', $time);
        $file_db->exec("INSERT INTO messages (id, title, message, time) 
                VALUES ('{$id}', '{$title}', '{$message}', '{$formatted_time}');");
        $file_db->exec("INSERT INTO messageSent (from, to, id) 
                VALUES ('{$from}', '{$to}', '{$id}');");

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function ChangePassword($user, $newPassword)
{
    try {
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $file_db->exec("UPDATE users 
                                  SET users.password = '{$newPassword}'
                                  WHERE users.login = '{$user}';");

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


function AddUser($login, $password, $valid, $role)
{
    try {
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $file_db->exec("INSERT INTO users (login, password, valid, role) 
                VALUES ('{$login}', '{$password}', '{$valid}', '{$role}');");

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function EditUser($login, $password, $valid, $role)
{
    try {
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $file_db->exec("UPDATE users
                                  SET users.password = '{$password}', users.valid = '{$valid}', users.role = '{$role}'
                                  WHERE users.login = '{$login}';");

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


function DeleteUser($login)
{
    try {
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $file_db->exec("DELETE FROM users 
                                  WHERE users.login = '{$login}';");

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function isUserValid($login, $password)
{
    try {
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $result = $file_db->query("SELECT * FROM users 
                                             WHERE users.login = '{$login}' AND users.password = '{$password}' AND users.valid = '1';");

        foreach ($result as $row) {
            if($row['login'] == $login){
                return true;
            }
        }

        return false;

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function isAdmin($login)
{
    try {
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $result = $file_db->query("SELECT * FROM users 
                                             WHERE users.role == '0' AND users.valid == '1';");
        foreach ($result as $row) {
            if($row['login'] == $login){
                return true;
            }
        }

        return false;

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>
