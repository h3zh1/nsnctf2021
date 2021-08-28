<title>W&M exclusive robot</title>

<style>
    h1 {text-align:center}
    p {text-align:center}
    form {text-align:center}
</style>

<head>
    <body>
        <h1>Fully automatic rp system</h1>
        <p>Come and get your rp value today!</p>
        <hr></hr>
        <form action="show.php" method="post">
        <input type="hidden" id="rp" name="rp" value="rp">
        <input type="submit" value="Get today's rp!">
        </form>
    </body>
</head>

<script>
    function ran(){
        var rp = Math.floor( Math.random() * 100);
        document.getElementById("rp").setAttribute('value',rp);
    }
    ran();
</script>

<!--
-------------------------------------------------------
Maybe there are some Easter eggs?
So where are them?
-->