<?php
/**
 * Database Migration Script
 * Safely updates the existing database with new schema enhancements
 * Run this once to upgrade your database structure
 */

require_once 'config/db.php';

// Redirect if not logged in or not admin
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$pdo = db();
$messages = [];
$errors = [];

function execute_sql($pdo, $sql, $description) {
    global $messages, $errors;
    try {
        $pdo->exec($sql);
        $messages[] = "✓ $description";
        return true;
    } catch (PDOException $e) {
        // Ignore "already exists" errors
        if (strpos($e->getMessage(), 'already exists') !== false || 
            strpos($e->getMessage(), 'Duplicate') !== false) {
            $messages[] = "⊙ $description (already exists)";
            return true;
        }
        $errors[] = "✗ $description - Error: " . $e->getMessage();
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['migrate'])) {
    $pdo->beginTransaction();
    
    try {
        // Step 1: Add new columns to users table
        execute_sql($pdo, "ALTER TABLE users ADD COLUMN IF NOT EXISTS email VARCHAR(100) NULL UNIQUE AFTER full_name", "Add email column to users");
        execute_sql($pdo, "ALTER TABLE users ADD COLUMN IF NOT EXISTS bio TEXT NULL AFTER profile_pic", "Add bio column to users");
        execute_sql($pdo, "ALTER TABLE users ADD COLUMN IF NOT EXISTS role_id INT UNSIGNED DEFAULT 3 AFTER security_answer", "Add role_id column to users");
        execute_sql($pdo, "ALTER TABLE users ADD COLUMN IF NOT EXISTS preferences JSON NULL AFTER role_id", "Add preferences column to users");
        execute_sql($pdo, "ALTER TABLE users ADD COLUMN IF NOT EXISTS is_active BOOLEAN DEFAULT TRUE AFTER preferences", "Add is_active column to users");
        execute_sql($pdo, "ALTER TABLE users ADD COLUMN IF NOT EXISTS created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP AFTER is_active", "Add created_at column to users");
        execute_sql($pdo, "ALTER TABLE users ADD COLUMN IF NOT EXISTS last_login TIMESTAMP NULL AFTER created_at", "Add last_login column to users");
        
        // Step 2: Add new columns to entries table
        execute_sql($pdo, "ALTER TABLE entries ADD COLUMN IF NOT EXISTS category_id INT UNSIGNED NULL AFTER user_id", "Add category_id column to entries");
        execute_sql($pdo, "ALTER TABLE entries ADD COLUMN IF NOT EXISTS location VARCHAR(100) NULL AFTER music_link", "Add location column to entries");
        execute_sql($pdo, "ALTER TABLE entries ADD COLUMN IF NOT EXISTS weather VARCHAR(50) NULL AFTER location", "Add weather column to entries");
        execute_sql($pdo, "ALTER TABLE entries ADD COLUMN IF NOT EXISTS privacy_level ENUM('private', 'friends', 'public') DEFAULT 'private' AFTER weather", "Add privacy_level column to entries");
        execute_sql($pdo, "ALTER TABLE entries ADD COLUMN IF NOT EXISTS is_favorite BOOLEAN DEFAULT FALSE AFTER privacy_level", "Add is_favorite column to entries");
        execute_sql($pdo, "ALTER TABLE entries ADD COLUMN IF NOT EXISTS is_deleted BOOLEAN DEFAULT FALSE AFTER is_favorite", "Add is_deleted column to entries");
        execute_sql($pdo, "ALTER TABLE entries ADD COLUMN IF NOT EXISTS version INT UNSIGNED DEFAULT 1 AFTER is_deleted", "Add version column to entries");
        execute_sql($pdo, "ALTER TABLE entries ADD COLUMN IF NOT EXISTS word_count INT UNSIGNED DEFAULT 0 AFTER version", "Add word_count column to entries");
        execute_sql($pdo, "ALTER TABLE entries ADD COLUMN IF NOT EXISTS updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER timestamp", "Add updated_at column to entries");
        execute_sql($pdo, "ALTER TABLE entries ADD COLUMN IF NOT EXISTS deleted_at TIMESTAMP NULL AFTER updated_at", "Add deleted_at column to entries");
        
        // Step 3: Add new columns to media table
        execute_sql($pdo, "ALTER TABLE media ADD COLUMN IF NOT EXISTS file_size INT UNSIGNED NULL AFTER file_type", "Add file_size column to media");
        execute_sql($pdo, "ALTER TABLE media ADD COLUMN IF NOT EXISTS uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP AFTER file_size", "Add uploaded_at column to media");
        
        // Step 4: Calculate word count for existing entries
        $stmt = $pdo->query("SELECT entry_id, content FROM entries WHERE word_count = 0");
        $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $update_stmt = $pdo->prepare("UPDATE entries SET word_count = ? WHERE entry_id = ?");
        foreach ($entries as $entry) {
            $word_count = str_word_count($entry['content']);
            $update_stmt->execute([$word_count, $entry['entry_id']]);
        }
        $messages[] = "✓ Updated word count for " . count($entries) . " existing entries";
        
        $pdo->commit();
        $messages[] = "<strong>Migration completed successfully!</strong>";
        
    } catch (Exception $e) {
        $pdo->rollBack();
        $errors[] = "Migration failed: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Migration - Diary App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto p-6">
        <div class="bg-gray-800 rounded-lg shadow-xl p-8">
            <h1 class="text-3xl font-bold mb-6 text-blue-400">Database Migration</h1>
            
            <div class="mb-6 p-4 bg-yellow-900/30 border border-yellow-600 rounded-lg">
                <p class="text-yellow-300">
                    <strong>⚠️ Warning:</strong> This will modify your database structure. Make sure you have a backup before proceeding.
                </p>
            </div>
            
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-3 text-gray-300">Migration will add:</h2>
                <ul class="list-disc list-inside space-y-2 text-gray-400">
                    <li>New columns to users table (email, bio, role_id, preferences, etc.)</li>
                    <li>New columns to entries table (category_id, location, privacy_level, etc.)</li>
                    <li>Word count calculation for existing entries</li>
                    <li>All new tables will be created when you run the enhanced schema.sql</li>
                </ul>
            </div>
            
            <?php if (!empty($messages)): ?>
            <div class="mb-6 p-4 bg-green-900/30 border border-green-600 rounded-lg">
                <h3 class="font-semibold mb-2 text-green-400">Migration Results:</h3>
                <?php foreach ($messages as $msg): ?>
                    <p class="text-sm text-gray-300"><?= $msg ?></p>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($errors)): ?>
            <div class="mb-6 p-4 bg-red-900/30 border border-red-600 rounded-lg">
                <h3 class="font-semibold mb-2 text-red-400">Errors:</h3>
                <?php foreach ($errors as $error): ?>
                    <p class="text-sm text-gray-300"><?= $error ?></p>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            
            <form method="POST" onsubmit="return confirm('Are you sure you want to run the migration?');">
                <button type="submit" name="migrate" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                    Run Migration
                </button>
                <a href="dashboard.php" class="ml-4 bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg inline-block transition duration-300">
                    Back to Dashboard
                </a>
            </form>
            
            <div class="mt-8 p-4 bg-blue-900/30 border border-blue-600 rounded-lg">
                <h3 class="font-semibold mb-2 text-blue-400">Next Steps:</h3>
                <ol class="list-decimal list-inside space-y-2 text-gray-400">
                    <li>Run this migration to update existing tables</li>
                    <li>Import the complete schema.sql file in phpMyAdmin to create all new tables</li>
                    <li>The system will automatically work with both old and new schema</li>
                </ol>
            </div>
        </div>
    </div>
</body>
</html>
