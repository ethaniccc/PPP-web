<?php
session_start();
$db = new SQLite3('posts.db');

$query = '
CREATE TABLE IF NOT EXISTS posts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    author TEXT NOT NULL,
    title TEXT NOT NULL,
    content TEXT NOT NULL,
    comments TEXT NOT NULL,
    time_created DATETIME DEFAULT CURRENT_TIMESTAMP
)';
$db->exec($query);

$author = $_POST['author'] ?? "";
$title = $_POST['title'] ?? "";
$content = $_POST['content'] ?? "";

if ($author == "" || $title == "" || $content == "") {
    session_regenerate_id();
    $_SESSION['error'] = "Please fill out all fields.";
    header("Location: index.php");
    return;
}

$query = $db->prepare('INSERT INTO posts (author, title, content, comments) VALUES (:author, :title, :content, :comments)');
$query->bindValue(':author', $author);
$query->bindValue(':title', $title);
$query->bindValue(':content', $content);
$query->bindValue(':comments', "{}");

if ($query->execute()) {
    session_regenerate_id();
    $_SESSION['success'] = "Post created successfully.";
    header("Location: index.php");
    return;
}

session_regenerate_id();
$_SESSION['error'] = "Error creating post.";
header("Location: index.php");