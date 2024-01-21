document.getElementById('commentForm').addEventListener('submit', function(event) {
    // Prevent the form from submitting
    event.preventDefault();

    // Get the comment from the form
    var comment = document.getElementById('comment').value;

    // Check if the comment is empty
    if (comment.trim() === '') {
        // If the comment is empty, stop the function here
        return;
    }

    // Create a new paragraph element for the comment
    var newComment = document.createElement('p');
    newComment.innerHTML = comment.replace(/\n/g, '<br>'); // Replace line breaks with <br>

    // Add the new comment to the comments section
    document.getElementById('commentsSection').appendChild(newComment);

    // Clear the comment form
    document.getElementById('comment').value = '';

    document.getElementById('comment').setAttribute('maxlength', '1000');
});