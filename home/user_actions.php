<?php
session_start();
require_once 'classes/auth.php';
require_once 'classes/userManager.php';

$auth = new auth();
$auth->requireAuth();

$userManager = new userManager();

$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {
    case 'create':
        handleCreate();
        break;
    case 'update':
        handleUpdate();
        break;
    case 'delete':
        handleDelete();
        break;
    default:
        redirect('users.php', 'Action non valide', 'error');
}

function handleCreate()
{
    global $auth, $userManager;

    $auth->requireRole('admin');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        redirect('users.php', 'Méthode non autorisée', 'error');
        return;
    }

    $data = [
        'username' => trim($_POST['username'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'password' => $_POST['password'] ?? '',
        'role' => $_POST['role'] ?? 'user',
        'first_name' => trim($_POST['first_name'] ?? ''),
        'last_name' => trim($_POST['last_name'] ?? ''),
        'phone' => trim($_POST['phone'] ?? ''),
        'active' => isset($_POST['active']) ? 1 : 0
    ];

    // Validation
    $errors = [];

    if (empty($data['username'])) {
        $errors[] = "Le nom d'utilisateur est requis";
    } elseif (strlen($data['username']) < 3) {
        $errors[] = "Le nom d'utilisateur doit contenir au moins 3 caractères";
    }

    if (empty($data['email'])) {
        $errors[] = "L'email est requis";
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'email n'est pas valide";
    }

    if (empty($data['password'])) {
        $errors[] = "Le mot de passe est requis";
    } elseif (strlen($data['password']) < 6) {
        $errors[] = "Le mot de passe doit contenir au moins 6 caractères";
    }

    if (!in_array($data['role'], ['admin', 'user', 'moderator'])) {
        $errors[] = "Rôle non valide";
    }

    if (!empty($errors)) {
        $_SESSION['form_data'] = $data;
        $_SESSION['form_errors'] = $errors;
        redirect('users.php?action=add', '', '');
        return;
    }

    try {
        // Vérifier si l'utilisateur existe déjà
        if ($userManager->userExists($data['username'], $data['email'])) {
            redirect('users.php?action=add', 'Un utilisateur avec ce nom ou cet email existe déjà', 'error');
            return;
        }

        // Créer l'utilisateur
        $userId = $userManager->createUser($data);

        if ($userId) {
            redirect('users.php', 'Utilisateur créé avec succès', 'success');
        } else {
            redirect('users.php?action=add', 'Erreur lors de la création de l\'utilisateur', 'error');
        }
    } catch (Exception $e) {
        error_log("Erreur création utilisateur: " . $e->getMessage());
        redirect('users.php?action=add', 'Erreur lors de la création de l\'utilisateur', 'error');
    }
}

function handleUpdate()
{
    global $auth, $userManager;

    $auth->requireRole('admin');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        redirect('users.php', 'Méthode non autorisée', 'error');
        return;
    }

    $userId = intval($_POST['user_id'] ?? 0);

    if (!$userId) {
        redirect('users.php', 'ID utilisateur manquant', 'error');
        return;
    }

    $data = [
        'username' => trim($_POST['username'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'role' => $_POST['role'] ?? 'user',
        'first_name' => trim($_POST['first_name'] ?? ''),
        'last_name' => trim($_POST['last_name'] ?? ''),
        'phone' => trim($_POST['phone'] ?? ''),
        'active' => isset($_POST['active']) ? 1 : 0
    ];

    // Ajouter le mot de passe seulement s'il est fourni
    if (!empty($_POST['password'])) {
        $data['password'] = $_POST['password'];
    }

    // Validation
    $errors = [];

    if (empty($data['username'])) {
        $errors[] = "Le nom d'utilisateur est requis";
    } elseif (strlen($data['username']) < 3) {
        $errors[] = "Le nom d'utilisateur doit contenir au moins 3 caractères";
    }

    if (empty($data['email'])) {
        $errors[] = "L'email est requis";
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'email n'est pas valide";
    }

    if (!empty($data['password']) && strlen($data['password']) < 6) {
        $errors[] = "Le mot de passe doit contenir au moins 6 caractères";
    }

    if (!in_array($data['role'], ['admin', 'user', 'moderator'])) {
        $errors[] = "Rôle non valide";
    }

    if (!empty($errors)) {
        $_SESSION['form_data'] = $data;
        $_SESSION['form_errors'] = $errors;
        redirect("users.php?action=edit&id=$userId", '', '');
        return;
    }

    try {
        // Vérifier si un autre utilisateur utilise déjà ce nom/email
        if ($userManager->userExistsExcept($data['username'], $data['email'], $userId)) {
            redirect("users.php?action=edit&id=$userId", 'Un autre utilisateur utilise déjà ce nom ou cet email', 'error');
            return;
        }

        // Empêcher un utilisateur de modifier son propre rôle
        $currentUser = $auth->getCurrentUser();
        if ($currentUser['id'] == $userId && $currentUser['role'] !== $data['role']) {
            redirect("users.php?action=edit&id=$userId", 'Vous ne pouvez pas modifier votre propre rôle', 'error');
            return;
        }

        // Mettre à jour l'utilisateur
        $success = $userManager->updateUser($userId, $data);

        if ($success) {
            redirect('users.php', 'Utilisateur mis à jour avec succès', 'success');
        } else {
            redirect("users.php?action=edit&id=$userId", 'Erreur lors de la mise à jour', 'error');
        }
    } catch (Exception $e) {
        error_log("Erreur mise à jour utilisateur: " . $e->getMessage());
        redirect("users.php?action=edit&id=$userId", 'Erreur lors de la mise à jour', 'error');
    }
}

function handleDelete()
{
    global $auth, $userManager;

    $auth->requireRole('admin');

    $userId = intval($_GET['id'] ?? $_POST['id'] >> 0);

    if (!$userId) {
        redirect('users.php', 'ID utilisateur manquant', 'error');
        return;
    }

    try {
        // Empêcher la suppression de son propre compte
        $currentUser = $auth->getCurrentUser();
        if ($currentUser['id'] == $userId) {
            redirect('users.php', 'Vous ne pouvez pas supprimer votre propre compte', 'error');
            return;
        }

        // Vérifier si l'utilisateur existe
        $user = $userManager->getUserById($userId);
        if (!$user) {
            redirect('users.php', 'Utilisateur introuvable', 'error');
            return;
        }

        // Confirmation de suppression (si pas encore confirmée)
        if (!isset($_POST['confirm_delete'])) {
            $_SESSION['delete_confirmation'] = [
                'user_id' => $userId,
                'username' => $user['username']
            ];
            redirect("users.php?action=confirm_delete&id=$userId", '', '');
            return;
        }

        // Supprimer l'utilisateur
        $success = $userManager->deleteUser($userId);

        if ($success) {
            redirect('users.php', "Utilisateur '{$user['username']}' supprimé avec succès", 'success');
        } else {
            redirect('users.php', 'Erreur lors de la suppression', 'error');
        }
    } catch (Exception $e) {
        error_log("Erreur suppression utilisateur: " . $e->getMessage());
        redirect('users.php', 'Erreur lors de la suppression', 'error');
    }
}

/**
 * Fonction utilitaire pour rediriger avec message
 */
function redirect($url, $message = '', $type = '')
{
    if (!empty($message)) {
        $_SESSION['flash_message'] = $message;
        $_SESSION['flash_type'] = $type;
    }

    header("Location: $url");
    exit;
}
