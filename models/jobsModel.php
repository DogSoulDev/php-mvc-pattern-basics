<?php

require_once("helper/dbConnection.php");

function get()
{
    $query = conn()->prepare("SELECT id, name, type FROM hobbies;");

    try {
        $query->execute();
        $hobbies = $query->fetchAll();
        return $hobbies;
    } catch (PDOException $e) {
        return [];
    }
}

function getById($id)
{
    $query = conn()->prepare("SELECT id, name, type
    FROM hobbies
    WHERE id = $id;");

    try {
        $query->execute();
        $job = $query->fetch();
        return $job;
    } catch (PDOException $e) {
        return [];
    }
}

function create($job)
{
    $query = conn()->prepare("INSERT INTO hobbies (name, type)
    VALUES
    (?, ?);");

    $query->bindParam(1, $job["name"]);
    $query->bindParam(2, $job["type"]);

    try {
        $query->execute();
        return [true];
    } catch (PDOException $e) {
        return [false, $e];
    }
}

function update($job)
{
    echo "update model";
    $query = conn()->prepare("UPDATE hobbies
    SET name = ?, type = ?
    WHERE id = ?;");

    $query->bindParam(1, $job["name"]);
    $query->bindParam(2, $job["type"]);
    $query->bindParam(3, $job["id"]);

    try {
        $query->execute();
        return [true];
    } catch (PDOException $e) {
        return [false, $e];
    }
}

function delete($id)
{
    $query = conn()->prepare("DELETE FROM hobbies WHERE id = ?");
    $query->bindParam(1, $id);

    try {
        $query->execute();
        return [true];
    } catch (PDOException $e) {
        return [false, $e];
    }
}