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
            <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
        </div>
        <!--Phone-->
        <div class="form-row">
            <div class="form-group">
                <label for="inputAreaCode">AreaCode</label>
                <input type="text" class="form-control" id="inputAreaCode" name="areaCode" value="<?php echo isset($_POST['areaCode']) ? $_POST['areaCode'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="inputNumber">Number</label>
                <input type="text" class="form-control" id="inputNumber" name="number" value="<?php echo isset($_POST['number']) ? $_POST['number'] : ''; ?>">
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
        </div>
    </div>
    <!--Address-->
    <div class="form-row">
        <div class="form-group">
            <label for="inputStreet">Street</label>
            <input type="text" class="form-control" id="inputStreet" name="street" value="<?php echo isset($_POST['street']) ? $_POST['street'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="inputHomeNumber">Home Number</label>
            <input type="text" class="form-control" id="inputHomeNumber" name="homeNumber" value="<?php echo isset($_POST['homeNumber']) ? $_POST['homeNumber'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="inputComplement">Complement</label>
            <input type="text" class="form-control" id="inputComplement" name="complement" value="<?php echo isset($_POST['complement']) ? $_POST['complement'] : ''; ?>">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputCity">City</label>
            <input type="text" class="form-control" id="inputCity" name="city" value="<?php echo isset($_POST['city']) ? $_POST['city'] : ''; ?>">
        </div>
        <div class="form-group col-md-4">
            <div class="form-group col-md-6">
                <label for="inputState">State</label>
                <input type="text" class="form-control" id="inputState" name="state" maxlength="2" value="<?php echo isset($_POST['state']) ? $_POST['state'] : ''; ?>">
            </div>
        </div>
        <div class="form-group col-md-2">
            <label for="inputZip">Zip</label>
            <input type="text" class="form-control" id="inputZip" name="zip" maxlength="9" value="<?php echo isset($_POST['zip']) ? $_POST['zip'] : ''; ?>">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
