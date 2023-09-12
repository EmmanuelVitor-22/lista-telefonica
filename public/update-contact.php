<?php

include __DIR__ . '/views/header.php'; ?>

<!--<div class="container">-->
<!--    <div class="jumbotron">-->
<!--        <h1 class="mt-4">Update Contact</h1>-->
<!--    </div>-->

    <!--AAAAAAAAAAAAA-->
<!--    <form method="post" action="/update-contact">-->
<!--        <input type="hidden" name="contact_id" value="--><?php //= $contact->getId(); ?><!--">-->
<!---->
<!--        <!-- contact  -->-->
<!--        <div class="form-group">-->
<!--            <label for="name">Name:</label>-->
<!--            <input type="text" class="form-control" name="name" value="--><?php //= $contact->getName(); ?><!--" required>-->
<!--        </div>-->
<!---->
<!--        <div class="form-group">-->
<!--            <label for="email">Email:</label>-->
<!--            <input type="email" class="form-control" name="email" value="--><?php //= $contact->getEmail(); ?><!--" required>-->
<!--        </div>-->
<!---->
<!--        <!-- ddress  -->-->
<!--        <div class="form-row">-->
<!--            <div class="form-group col-md-6">-->
<!--                <label for="street">Street:</label>-->
<!--                <input type="text" class="form-control" name="street"-->
<!--                       value="--><?php //= $contact->getAddress()->getStreet(); ?><!--" required>-->
<!--            </div>-->
<!---->
<!--            <div class="form-group col-md-3">-->
<!--                <label for="number">Number:</label>-->
<!--                <input type="text" class="form-control" name="number"-->
<!--                       value="--><?php //= $contact->getAddress()->getNumber(); ?><!--" required>-->
<!--            </div>-->
<!---->
<!--            <div class="form-group col-md-3">-->
<!--                <label for="complement">Complement:</label>-->
<!--                <input type="text" class="form-control" name="complement"-->
<!--                       value="--><?php //= $contact->getAddress()->getComplement(); ?><!--">-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="form-row">-->
<!--            <div class="form-group col-md-4">-->
<!--                <label for="zipCode">ZIP Code:</label>-->
<!--                <input type="text" class="form-control" name="zipCode"-->
<!--                       value="--><?php //= $contact->getAddress()->getZipCode(); ?><!--" required>-->
<!--            </div>-->
<!---->
<!--            <div class="form-group col-md-4">-->
<!--                <label for="city">City:</label>-->
<!--                <input type="text" class="form-control" name="city" value="--><?php //= $contact->getAddress()->getCity(); ?><!--"-->
<!--                       required>-->
<!--            </div>-->
<!---->
<!--            <div class="form-group col-md-4">-->
<!--                <label for="state">State:</label>-->
<!--                <input type="text" class="form-control" name="state" value="--><?php //= $contact->getAddress()->getState(); ?><!--"-->
<!--                       required>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!---->
<!--        <div class="row">-->
<!--            <!-- Phone 1 -->-->
<!--            <div class="col-md-6">-->
<!--                <h2>Phone 1</h2>-->
<!--                <div class="mb-3">-->
<!--                    <label for="areaCode1" class="form-label">Area Code:</label>-->
<!--                    <input type="text" class="form-control" id="areaCode1" name="areaCode1"-->
<!--                           value="--><?php //= $contact->getPhones()[0]->getAreaCode(); ?><!--" required>-->
<!--                </div>-->
<!--                <div class="mb-3">-->
<!--                    <label for="phoneNumber1" class="form-label">Phone Number:</label>-->
<!--                    <input type="text" class="form-control" id="phoneNumber1" name="phoneNumber1"-->
<!--                           value="--><?php //= $contact->getPhones()[0]->getNumber(); ?><!--" required>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <!-- Phone 2 -->-->
<!--            <div class="col-md-6">-->
<!--                <h2>Phone 2</h2>-->
<!--                <div class="mb-3">-->
<!--                    <label for="areaCode2" class="form-label">Area Code:</label>-->
<!--                    <input type="text" class="form-control" id="areaCode2" name="areaCode2"-->
<!--                           value="--><?php //= $contact->getPhones()[1]->getAreaCode(); ?><!--" required>-->
<!--                </div>-->
<!--                <div class="mb-3">-->
<!--                    <label for="phoneNumber2" class="form-label">Phone Number:</label>-->
<!--                    <input type="text" class="form-control" id="phoneNumber2" name="phoneNumber2"-->
<!--                           value="--><?php //= $contact->getPhones()[1]->getNumber(); ?><!--" required>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <button type="submit" class="btn btn-primary">Update</button>-->
<!--    </form>-->
<!--FIM AAAAAAAAAAA-->

    <form method="POST" action="/../lista-telefonica/app/Controller/UpdateContactController.php">
        <!-- Contact -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $contact->getName(); ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" name="email" value="<?php echo $contact->getEmail(); ?>">
            </div>
        </div>
        <!-- Address -->
        <div class="form-row">
            <div class="form-group">
                <label for="inputStreet">Street</label>
                <input type="text" class="form-control" id="inputStreet" name="street" value="<?php echo $contact->getAddress()->getStreet(); ?>">
            </div>
            <div class="form-group">
                <label for="inputHomeNumber">Home Number</label>
                <input type="text" class="form-control" id="inputHomeNumber" name="homeNumber" value="<?php echo $contact->getAddress()->getNumber(); ?>">
            </div>
            <div class="form-group">
                <label for="inputComplement">Complement</label>
                <input type="text" class="form-control" id="inputComplement" name="complement" value="<?php echo $contact->getAddress()->getComplement(); ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity" name="city" value="<?php echo $contact->getAddress()->getCity(); ?>">
            </div>
            <div class="form-group col-md-4">
                <div class="form-group col-md-6">
                    <label for="inputState">State</label>
                    <input type="text" class="form-control" id="inputState" name="state" maxlength="2" value="<?php echo $contact->getAddress()->getState(); ?>">
                </div>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="text" class="form-control" id="inputZip" name="zip" maxlength="9" value="<?php echo $contact->getAddress()->getZipCode(); ?>">
            </div>
        </div>
        <!-- Phones -->
        <h2>Phones</h2>
        <?php foreach ($contact->getPhones() as $phone): ?>
            <div class="form-row">
                <div class="form-group">
                    <label for="inputAreaCode">AreaCode</label>
                    <input type="text" class="form-control" name="inputAreaCode[<?php echo $phone->getId(); ?>][area_code]" value="<?php echo $phone->getAreaCode(); ?>">
                </div>
                <div class="form-group">
                    <label for="inputNumber">Number</label>
                    <input type="text" class="form-control" name="inputNumber[<?php echo $phone->getId(); ?>][phone_number]" value="<?php echo $phone->getNumber(); ?>">
                </div>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>

<!--    <form method="POST" action="/update-contact">-->
<!--        <!--Contact-->-->
<!--        <div class="form-row">-->

<!--            <div class="form-group col-md-6">-->
<!--                <label for="name">Name</label>-->


<!--                <input type="text" class="form-control" id="name" name="name" value="--><?php //echo $contact->getName() ;?><!--">-->


<!--            </div>-->


            <!--            <!--Phone-->-->
<!--            <div class="form-row">-->
<!--                <div class="form-group">-->
<!--                    <label for="inputAreaCode">AreaCode</label>-->
<!--                    <input type="text" class="form-control" id="inputAreaCode" name="areaCode"  >-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <label for="inputNumber">Number</label>-->
<!--                    <input type="text" class="form-control" id="inputNumber" name="number" value="--><?php //$contato-> ?><!--">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="form-group col-md-6">-->
<!--                <label for="inputEmail">Email</label>-->
<!--                <input type="email" class="form-control" id="inputEmail" name="email" value="--><?php //$contato-> ?><!--">-->
<!--            </div>-->
<!--        </div>-->
<!--        <!--Addres-->-->
<!--        <div class="form-row">-->
<!--            <div class="form-group">-->
<!--                <label for="inputStreet">Street</label>-->
<!--                <input type="text" class="form-control" id="inputStreet" name="street" value="--><?php //$contato-> ?><!--">-->
<!--            </div><div class="form-group">-->
<!--                <label for="inputNumber">Number</label>-->
<!--                <input type="text" class="form-control" id="inputNumber" name="homeNumber" value="--><?php //$contato-> ?><!--">-->
<!--            </div><div class="form-group">-->
<!--                <label for="inputComplement">Complement</label>-->
<!--                <input type="text" class="form-control" id="inputComplement" name="complement" value="--><?php //$contato-> ?><!--">-->
<!--            </div>-->
<!--            <div class="form-row">-->
<!--                <div class="form-group col-md-6">-->
<!--                    <label for="inputCity">City</label>-->
<!--                    <input type="text" class="form-control" id="inputCity"  name="city" value="--><?php //$contato-> ?><!--">-->
<!--                </div>-->
<!--                <div class="form-group col-md-4">-->
<!--                    <div class="form-group col-md-6">-->
<!--                        <label for="inputState">State</label>-->
<!--                        <input type="text" class="form-control" id="inputState" name="state" maxlength="2" value="--><?php //$contato-> ?><!--">-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="form-group col-md-2">-->
<!--                    <label for="inputZip">Zip</label>-->
<!--                    <input type="text" class="form-control" id="inputZip"  name="zip" maxlength="9"  value="--><?php //$contato-> ?><!--">-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <!-- Campos de telefone -->-->
<!--            <div class="row">-->
<!--                <!-- Telefone 1 -->-->
<!--                <div class="col-md-6">-->
<!--                    <h2>Telefone 1</h2>-->
<!--                    <div class="mb-3">-->
<!--                        <label for="areaCode1" class="form-label">Código de Área:</label>-->
<!--                        <input type="text" class="form-control" id="areaCode1" name="areaCode1" required>-->
<!--                    </div>-->
<!--                    <div class="mb-3">-->
<!--                        <label for="phoneNumber1" class="form-label">Número de Telefone:</label>-->
<!--                        <input type="text" class="form-control" id="phoneNumber1" name="phoneNumber1" required>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <!-- Telefone 2 -->-->
<!--                <div class="col-md-6">-->
<!--                    <h2>Telefone 2</h2>-->
<!--                    <div class="mb-3">-->
<!--                        <label for="areaCode2" class="form-label">Código de Área:</label>-->
<!--                        <input type="text" class="form-control" id="areaCode2" name="areaCode2" required>-->
<!--                    </div>-->
<!--                    <div class="mb-3">-->
<!--                        <label for="phoneNumber2" class="form-label">Número de Telefone:</label>-->
<!--                        <input type="text" class="form-control" id="phoneNumber2" name="phoneNumber2" required>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div></div>-->


        <button type="submit" class="btn btn-primary" >Save</button>
    </form>
</div>

<?php include __DIR__ . '/views/footer.php'; ?>
