<div>
    @foreach($names as $name)
    <p>HI {{$name}}</p>
    @endforeach
    <p>Man labai patinka: {{$subject}}</p>
</div>

<?php
    /*
M - models (business logic)
V - Views (presentation layer)
C - controllers (then get request from route, ask model about data and return to view
*/
    ?>
