<?php

include __DIR__ . '/views/header.php'; ?>

<div class="container">
    <div class="jumbotron">
        <h1 class="mt-4">Update Contact</h1>
    </div>

    <form method="post" action="/update-contact">

        <input type="hidden" name="contact_id" value="<?= $contact->getId(); ?>">

        <!-- contact  -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="<?= $contact->getName(); ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="<?= $contact->getEmail(); ?>" required>
        </div>

        <!-- ddress  -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="street">Street:</label>
                <input type="text" class="form-control" name="street"
                       value="<?= $contact->getAddress()->getStreet(); ?>" required>
            </div>

            <div class="form-group col-md-3">
                <label for="number">Number:</label>
                <input type="text" class="form-control" name="number"
                       value="<?= $contact->getAddress()->getNumber(); ?>" required>
            </div>

            <div class="form-group col-md-3">
                <label for="complement">Complement:</label>
                <input type="text" class="form-control" name="complement"
                       value="<?= $contact->getAddress()->getComplement(); ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="zipCode">ZIP Code:</label>
                <input type="text" class="form-control" name="zipCode"
                       value="<?= $contact->getAddress()->getZipCode(); ?>" required>
            </div>

            <div class="form-group col-md-4">
                <label for="city">City:</label>
                <input type="text" class="form-control" name="city" value="<?= $contact->getAddress()->getCity(); ?>"
                       required>
            </div>

            <div class="form-group col-md-4">
                <label for="state">State:</label>
                <input type="text" class="form-control" name="state" value="<?= $contact->getAddress()->getState(); ?>"
                       required>
            </div>
        </div>


        <div class="row">
            <!-- Phone 1 -->
            <div class="col-md-6">
                <h2>Phone 1</h2>
                <div class="mb-3">
                    <label for="areaCode1" class="form-label">Area Code:</label>
                    <input type="text" class="form-control" id="areaCode1" name="areaCode1"
                           value="<?= $contact->getPhones()[0]->getAreaCode(); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="phoneNumber1" class="form-label">Phone Number:</label>
                    <input type="text" class="form-control" id="phoneNumber1" name="phoneNumber1"
                           value="<?= $contact->getPhones()[0]->getNumber(); ?>" required>
                </div>
            </div>

            <!-- Phone 2 -->
            <div class="col-md-6">
                <h2>Phone 2</h2>
                <div class="mb-3">
                    <label for="areaCode2" class="form-label">Area Code:</label>
                    <input type="text" class="form-control" id="areaCode2" name="areaCode2"
                           value="<?= $contact->getPhones()[1]->getAreaCode(); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="phoneNumber2" class="form-label">Phone Number:</label>
                    <input type="text" class="form-control" id="phoneNumber2" name="phoneNumber2"
                           value="<?= $contact->getPhones()[1]->getNumber(); ?>" required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

</div>

<?php include __DIR__ . '/views/footer.php'; ?>
