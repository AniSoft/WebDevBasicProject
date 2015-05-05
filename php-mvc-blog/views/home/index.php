<h1>Welcome to Home!</h1>
<a href="/account/register">Register</a>
<a href="/account/login">Login</a>
<br/>
<button id="show-books">Show books</button>
<div id="books"></div>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script>
    var showBooksButton = document.getElementById('show-books');
    showBooksButton.addEventListener('click', function (ev) {
        $.ajax({
            url: '/books',
            method: 'GET'
        }).done(function (data) {
            $('#books').html(data);
        });
    }, false);
</script>