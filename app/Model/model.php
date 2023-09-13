/**
* @throws \Exception
*/
public static function displayUpdateForm(): void
{
if (isset($_GET['id'])) {
$contactId = (int)$_GET['id'];

$contact = Contact::findById($contactId);

if ($contact) {
require __DIR__ . "/../../public/update-contact.php";
return;
}
}

// Trate o cenário em que o contato não foi encontrado ou o parâmetro está ausente
echo "Contato não encontrado ou ID inválido.";
}