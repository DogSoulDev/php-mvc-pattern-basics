<?php

require_once("helper/dbConnection.php");

function get()
{
    $query = conn()->prepare("SELECT id, name, type
    FROM jobs;");

    try {
        $query->execute();
        $jobs = $query->fetchAll();
        return $jobs;
    } catch (PDOException $e) {
        return [];
    }
}

function getById($id)
{
    $query = conn()->prepare("SELECT id, name, type
    FROM jobs
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
    $query = conn()->prepare("INSERT INTO jobs (name, type)
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
    $query = conn()->prepare("UPDATE jobs
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
    $query = conn()->prepare("DELETE FROM jobs WHERE id = ?");
    $query->bindParam(1, $id);

    try {
        $query->execute();
        return [true];
    } catch (PDOException $e) {
        return [false, $e];
    }
}