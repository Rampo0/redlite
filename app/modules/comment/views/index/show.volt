<h1>{{ post.title }}</h1>
<img src="{{ url.get('files/' ~ post.file) }}" alt="">
<h2>{{ post.description }}</h6>

<br><br>
{% if (getDI().getShared('session').has('user_id')) %}
<h4>Add New Comment</h5>
<form action="/comment/index/create/{{ post.id }}" role="form" method="POST" id="newComment">
    <textarea name="content" cols="55" rows="5" form="newComment" placeholder="Add new comment" class="form-control"></textarea><br>
    <input type="submit" value="Add Comment" class="btn btn-primary">
</form>
{% else %}
<h6>Login To Comment</h6>
{% endif %}

<br><br>
<h4>All Comments</h3>
{% for comment in comments %}
<div class="row" style="margin: 10px;">
    <div class="card col-sm-6">
        <h1>{{ comment.content() }}</h1>
    </div>
    <div class="col-sm-2">
        <div style="margin: 10px;">
            <h6>Rating : {{ comment.averageRating() }}</h6> 
        </div>
    </div>
    <div class="col-s-2">
        {% if (getDI().getShared('session').has('user_id')) %}
            {% if (comment.isRated()) %}
            <a href="/comment/index/unrate/{{ comment.id() }}"><button style='margin : 3px' class='btn btn-primary' type='submit'>Unrate</button></a>
            {% else %}
            <form method='post' action='/comment/index/rating/{{ comment.id() }}' class='rating-form form-inline'>
                <input placeholder='Rate 1 - 5' step='1' max='5' type='number' name='rating' class='form-control rating-input' ></input>
                <input id='ed-postid' type='hidden' name='comment_id' value='{{ comment.id() }}' />
                <button style='margin : 3px' class='btn btn-primary' type='submit'>Rate</button>
            </form>
            {% endif %}
        {% else %}
            <h6>Login To Rate</h6>
        {% endif %}
    </div>  
    <div class="col-s-2">
        {% if (getDI().getShared('session').has('user_id')) %}
            {% if (comment.userId() == getDI().getShared('session').get('user_id')) %}
            <a href="/comment/index/edit/{{ comment.id() }}"><button style='margin : 3px' class='btn btn-primary' type='submit'>Edit</button></a>
            <form method='post' action='/comment/index/delete/{{ comment.id() }}' class='rating-form'>
                <input id='ed-postid' type='hidden' name='post_id' value='{{ post.id }}' />
                <button style='margin : 3px' class='btn btn-danger' type='submit'>Delete</button>
            </form>
            {% endif %}
        {% endif %}
    </div>
</div>
{% endfor %}