<div class="container">
    <?php
    include 'header.php';
    ?>
</div>
<form method="POST" action="/../lista-telefonica/app/Controller/ListController.php">
    <!--Contact-->
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php ?>">
        </div>
        <!--Phone-->
        <div class="form-row">
            <div class="form-group">
                <label for="inputAreaCode">AreaCode</label>
                <input type="text" class="form-control" id="inputAreaCode" name="areaCode"  >
            </div>
            <div class="form-group">
                <label for="inputNumber">Number</label>
                <input type="text" class="form-control" id="inputNumber" name="number" value="<?php ?>">
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" name="email" value="<?php ?>">
        </div>
    </div>
    <!--Addres-->
    <div class="form-row">
        <div class="form-group">
            <label for="inputStreet">Street</label>
            <input type="text" class="form-control" id="inputStreet" name="street" value="<?php ?>">
        </div><div class="form-group">
            <label for="inputNumber">Number</label>
            <input type="text" class="form-control" id="inputNumber" name="homeNumber" value="<?php ?>">
        </div><div class="form-group">
            <label for="inputComplement">Complement</label>
            <input type="text" class="form-control" id="inputComplement" name="complement" value="<?php ?>">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity"  name="city" value="<?php ?>">
            </div>
            <div class="form-group col-md-4">
                <div class="form-group col-md-6">
                    <label for="inputState">State</label>
                    <input type="text" class="form-control" id="inputState" name="state" maxlength="2" value="<?php ?>">
                </div>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="text" class="form-control" id="inputZip"  name="zip" maxlength="9"  value="<?php ?>">
            </div>
        </div>
    </div>


    <button type="submit" class="btn btn-primary" >Save</button>
</form>