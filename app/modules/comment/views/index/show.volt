<h1>{{ post.title }}</h1>
<img src="{{ url.get('files/' ~ post.file) }}" alt="">
<h2>{{ post.description }}</h6>

<br><br>
{% if (post.able_to_comment == 1) %}

    {% if (getDI().getShared('session').has('user_id')) %}
    <a href="/subredlite/mods/lock/{{ post.id }}"><button style='margin : 3px' class='btn btn-primary btn-sm' type='submit'>Lock Comment Section</button></a>

    <h4>Add New Comment</h5>
    <form action="/comment/index/create/{{ post.id }}" role="form" method="POST" id="newComment">
        <textarea name="content" cols="55" rows="5" form="newComment" placeholder="Add new comment" class="form-control"></textarea><br>
        <input type="submit" value="Add Comment" class="btn btn-primary">
    </form>
    {% else %}
    <h6>Login To Comment</h6>
    {% endif %}
{% else %}
<h6>Comment locked by moderator!</h6>
{% endif %}

<br><br>
<h4>All Comments</h3>
{% for comment in comments %}
<div class="row" style="margin: 10px;">
    <div class="card col-sm-9">
        <h1>{{ comment.content() }}</h1>
    </div>
    <div class="col-sm-3">
        <div style="margin: 10px;">
            Rating : {{ comment.averageRating() }}
        </div>
    </div>
    <div class="col-s-3">
        {% if (getDI().getShared('session').has('user_id')) %}
            {% if (comment.userId() == getDI().getShared('session').get('user_id')) %}
            <form method='post' action='/comment/index/delete/{{ comment.id() }}' class='rating-form'>
                <input id='ed-postid' type='hidden' name='post_id' value='{{ post.id }}' />
                <button style='margin : 3px' class='btn btn-primary btn-sm col-sm-5' type='submit'>Delete</button>
            </form>
            <a href="/comment/index/edit/{{ comment.id() }}"><button style='margin : 3px' class='btn btn-primary btn-sm col-sm-5' type='submit'>Edit</button></a>
            {% endif %}
        {% endif %}
        {% if (comment.isRated()) %}
        <a href="/comment/index/unrate/{{ comment.id() }}"><button style='margin : 3px' class='btn btn-primary btn-sm col-sm-5' type='submit'>Unrate</button></a>
        {% else %}
        <form method='post' action='/comment/index/rating/{{ comment.id() }}' class='rating-form'>
            <input placeholder='Rate 1 - 5' step='1' max='5' type='number' name='rating' class='form-control rating-input' ></input>
          
            <input id='ed-postid' type='hidden' name='comment_id' value='{{ comment.id() }}' />

            <div class='row no-gutters justify-content-center'>
                <button style='margin : 3px' class='btn btn-primary btn-sm col-sm-5' type='submit'>Rate</button>
            </div>
        </form>
        {% endif %}    
    </div>
</div>
{% endfor %}