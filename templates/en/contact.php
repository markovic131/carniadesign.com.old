<div id="welcomeWrap">
    <h1>Get In Touch</h1>
</div>
<div class="container">
    <div class="row text-center">
        <div class="col-md-6">
            <h1>We Would Like to Talk.</h1>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
            </p>
            <hr>
                <h2><script type="text/javascript">eval(unescape("%71%6b%75%75%71%39%31%3d%5b%27%25%36%39%25%36%65%25%36%36%25%36%66%27%2c%5b%27%25%36%33%25%36%66%25%36%64%27%2c%27%25%36%33%25%36%31%25%37%32%25%36%65%25%36%39%25%36%31%25%36%34%25%36%35%25%37%33%25%36%39%25%36%37%25%36%65%27%5d%2e%72%65%76%65%72%73%65%28%29%2e%6a%6f%69%6e%28%27%2e%27%29%5d%2e%6a%6f%69%6e%28%27%40%27%29%3b%6e%63%77%69%77%38%36%3d%75%6e%65%73%63%61%70%65%28%71%6b%75%75%71%39%31%29%3b%64%6f%63%75%6d%65%6e%74%2e%77%72%69%74%65%28%6e%63%77%69%77%38%36%2e%6c%69%6e%6b%28%27%6d%61%69%27%2b%27%6c%74%6f%3a%27%2b%71%6b%75%75%71%39%31%29%29%3b"));</script></h2>
            <p role="address">
                +389 70 799 701
            </p>
        </div>
        <div class="col-md-6">
            <h1 id="drop-us-line">Drop us a line.</h1>
            <form method="post" id="contact" role="form">
                <div class="form-group">
                    <input type="name" name="name" class="form-control" id="contactName" placeholder="Name">
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" id="contactEmail" placeholder="Email">
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="3" name="message" placeholder="You Message"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" id="contactSubmitButton">Send</button>
                </div>
                <input type="hidden" name="lang" value="<?=$lang?>">
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('form#contact').on('submit',function(e){
            alert(1);
            return false;
            e.preventDefault();
            submitContactForm();
            return false;
        });
    });
</script>
<!-- <div class="contactmap hidden-phone">
    <iframe width="100%" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/?ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=37.735377,86.572266&amp;t=m&amp;z=4&amp;output=embed"></iframe>
</div> -->