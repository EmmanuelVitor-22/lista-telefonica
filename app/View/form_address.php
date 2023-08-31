<div class="container">
    <?php
    include 'header.php';
    ?>
</div>
<form method="POST" action="/../lista-telefonica/app/Model/Contact.php">
    <!--Contact-->
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="name" required>
        </div>
        <!--Phone-->
        <div class="form-row">
            <div class="form-group">
                <label for="inputAreaCode">AreaCode</label>
                <input type="text" class="form-control" id="inputAreaCode" placeholder="(75)" required >
            </div>
            <div class="form-group">
                <label for="inputNumber">Number</label>
                <input type="text" class="form-control" id="inputNumber" placeholder="99999-9999" required>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" placeholder="Email" required>
        </div>
    </div>
    <!--Addres-->
    <div class="form-row">
        <div class="form-group">
            <label for="inputStreet">Street</label>
            <input type="text" class="form-control" id="inputStreet" placeholder="Rua x" required>
        </div><div class="form-group">
            <label for="inputNumber">Number</label>
            <input type="text" class="form-control" id="inputNumber" placeholder="123" required>
        </div><div class="form-group">
            <label for="inputComplement">Complement</label>
            <input type="text" class="form-control" id="inputComplement" placeholder="1º andar" >
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity"  placeholder="Salvador" required>
            </div>
            <div class="form-group col-md-4">
                <div class="form-group col-md-6">
                    <label for="inputState">State</label>
                    <input type="text" class="form-control" id="inputState" maxlength="2" placeholder="BA" required>
                </div>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="text" class="form-control" id="inputZip"  maxlength="9"  placeholder="00000-000" required>
            </div>
        </div>
    </div>


    <button type="submit" class="btn btn-primary" >Save</button>
</form>