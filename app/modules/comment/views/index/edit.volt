<form action="/comment/index/save/{{ comment.id() }}" role="form" method="POST" id="newComment">
    <textarea name="content" cols="55" rows="5" form="newComment" placeholder="Add new comment" class="form-control">{{ comment.content() }}</textarea><br>
    <input type="submit" value="Save Comment" class="btn btn-primary">
</form>