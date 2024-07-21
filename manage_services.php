<?php
session_start();
include "db.php"; // Connexion à la base de données

// Vérifier si l'utilisateur est connecté et a le bon rôle
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Traitement de la demande d'ajout d'un nouveau service
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_service'])) {
    $nom = $_POST['nom'];

