<div class="box box-success def-content">
    <div class="box-header">
        <div>{{ this.flashSession.output() }}</div>
        <div style="margin-top: 10px;margin-left: 30%">
            <form action="" method="post">
                <label style="font-size: 20px">Web subscriber: </label>
                <input type="text" id="websubscriber"
                       name="websubscriber"
                       value="{{ websubscriber }}"
                       style="font-size: 18px;width: 308px;height: 33px;"/>

                <input type="submit" class="btn btn-primary" value="Save" style="margin-top: -6px"/>
            </form>

        </div>
    </div>
</div>