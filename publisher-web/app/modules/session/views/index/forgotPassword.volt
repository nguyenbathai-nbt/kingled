{{ this.flashSession.output() }}
{{ this.flash.output() }}
<div class="login-box">
    <div class="login-box-body">
        {{ form('class': 'form-search') }}

        <div align="left">
            <h2>Forgot Password?</h2>
        </div>
        <div class="form-group">
            {{ form.render('email') }}
        </div>
        <div class="form-group">
            {{ form.render('Send') }}
        </div>
        <hr>
        </form>
    </div>

</div>