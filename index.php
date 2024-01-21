<!DOCTYPE html>
<?php
    session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Problamtic Problem Posting</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>Problamatic Problem Posting (PPP)</h1>
    <h3>Problamatic Problem Posting (PPP) is a website that allows users to post problems they are having and other users can comment on the problem to help solve it.</h3>    
    
    
    <!-- Post Form -->
    <form id="postForm" method="post" action="new_post.php" style="margin-left: 20px;">
        <label for="author" style="color: white; background-color: black;">Author:</label><br>
        <input type="text" id="author" name="author" style="resize: none;" maxlength="32"><br>

        <label for="title" style="color: white; background-color: black;">Post Title:</label><br>
        <input type="text" id="title" name="title" style="resize: none;" maxlength="1000"><br>
        
        <label for="content" style="color: white; background-color: black;">Post Content:</label><br>
        <textarea id="content" name="content" rows="10" cols="80" style="resize: none;" maxlength="1000"></textarea><br>
        
        <input type="submit" value="Submit Post">
        
        <?php
            if (isset($_SESSION["error"])) {
                echo "<p style='color: red;'>" . $_SESSION["error"] . "</p>";
                unset($_SESSION["error"]);
            } elseif (isset($_SESSION["success"])) {
                echo "<p style='color: green;'>" . $_SESSION["success"] . "</p>";
                unset($_SESSION["success"]);
            }
        ?>
    </form>

    <!-- Posts Display Area -->
    <div id="postsDisplayArea"></div>
    <?php
        // Fetch posts from the database
        $db = new SQLite3("posts.db");
        $query = '
        CREATE TABLE IF NOT EXISTS posts (
            id INTEGER PRIMARY KEY,
            author TEXT NOT NULL,
            title TEXT NOT NULL,
            content TEXT NOT NULL,
            comments TEXT NOT NULL,
            time_created DATETIME DEFAULT CURRENT_TIMESTAMP
        )';
        $db->exec($query);

        $q = $db->query("SELECT * FROM posts ORDER BY id DESC");    
        while ($post = $q->fetchArray(SQLITE3_ASSOC)) {
            // Display the post
            echo '<div class="post">';
            echo '<h2>' . $post['title'] . '</h2>';
            echo '<p>By ' . $post['author'] . '</p>';
            echo '<p>' . $post['content'] . '</p>';
            echo '</div>';
        }
    ?>
</body>
</html>