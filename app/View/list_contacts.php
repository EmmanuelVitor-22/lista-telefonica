<div>
    <?php use App\Model\Contact;

    $obj = new Contact();
    foreach ($obj as $d){
        echo $d->findAll();
    }
        ?>


</div>
