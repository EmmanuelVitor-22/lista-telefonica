<?php include __DIR__ . '/views/header.php'; ?>

<div class="container">
    <div class="jumbotron">
        <h1 class="mt-4">Update Contact</h1>
    </div>

    <form method="POST" action="/update-contact">
        <!-- Contact -->
        <input type="hidden" name="contact_id" value="<?php echo $contact->getId(); ?>">

        <div class="card mb-3">
            <div class="card-header">
                Contact Information
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $contact->getName(); ?>">
                </div>
                <div class="form-group">
                    <label for="inputEmail">Email:</label>
                    <input type="email" class="form-control" id="inputEmail" name="email" value="<?php echo $contact->getEmail(); ?>">
                </div>
            </div>
        </div>

        <!-- Address -->
        <div class="card mb-3">
            <div class="card-header">
                Address
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="inputStreet">Street:</label>
                    <input type="text" class="form-control" id="inputStreet" name="street" value="<?php echo $contact->getAddress()->getStreet(); ?>">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputHomeNumber">Home Number:</label>
                        <input type="text" class="form-control" id="inputHomeNumber" name="homeNumber" value="<?php echo $contact->getAddress()->getHomeNumber(); ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputComplement">Complement:</label>
                        <input type="text" class="form-control" id="inputComplement" name="complement" value="<?php echo $contact->getAddress()->getComplement(); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputCity">City:</label>
                        <input type="text" class="form-control" id="inputCity" name="city" value="<?php echo $contact->getAddress()->getCity(); ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">State:</label>
                        <input type="text" class="form-control" id="inputState" name="state" maxlength="2" value="<?php echo $contact->getAddress()->getState(); ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputZip">Zip:</label>
                        <input type="text" class="form-control" id="inputZip" name="zip" maxlength="9" value="<?php echo $contact->getAddress()->getZipCode(); ?>">
                    </div>
                </div>
            </div>
        </div>

        <!-- Phones -->
        <div class="card">
            <div class="card-header">
                Phones
            </div>
            <div class="card-body">
                <?php for ($i = 1; $i <= 2; $i++): ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputAreaCode<?php echo $i; ?>">Area Code:</label>
                            <input type="text" class="form-control" name="inputAreaCode<?php echo $i; ?>" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputNumber<?php echo $i; ?>">Number:</label>
                            <input type="text" class="form-control" name="inputNumber<?php echo $i; ?>" value="">
                        </div>
                    </div>
                <?php endfor; ?>

               </div>
        </div>


        <button type="submit" class="btn btn-primary mt-3">Save</button>
    </form>
</div>

<?php include __DIR__ . '/views/footer.php'; ?>
