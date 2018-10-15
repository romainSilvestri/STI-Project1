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
                    from TEXT, 
                    to TEXT,
                    id INTEGER,
                    FOREIGN KEY (from) REFERENCES users(login) ON DELETE CASCADE,
                    FOREIGN KEY (to) REFERENCES users(login) ON DELETE CASCADE,
                    FOREIGN KEY (time) REFERENCES message(time) ON DELETE CASCADE);");

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
                                                  FROM messages
                                                  INNER JOIN messageSent
                                                    ON messages.id = messageSent.id
                                                  WHERE to = $user
                                                  ORDER BY messages.time;");

        foreach ($result as $row) {
            echo "Id: " . $row['id'] . "<br/>";
            echo "Title: " . $row['title'] . "<br/>";
            echo "Message: " . $row['message'] . "<br/>";
            echo "Time: " . $row['time'] . "<br/>";
            echo "<br/>";
        }

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


        $result = $file_db->query("SELECT *
                                  FROM users 
                                  WHERE users.login = '{$login}' AND users.password = '{$password}' AND users.valid = '1';");
        return sizeof($result) > 0;

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


        $result = $file_db->query("SELECT *
                                  FROM users 
                                  WHERE users.login = '{$login}' AND users.role == 'admin' AND users.valid = '1';");
        return sizeof($result) > 0;

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>
