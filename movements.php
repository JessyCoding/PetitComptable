
<form method="POST" action="test.php">
    <p>
        <span>Une petite transaction ?</span>
    </p>
    <select name="account">
        <option value="1">Test</option>
    </select>
    <input type="text" name="name" placeHolder="Nom de la transaction"/></br>
    <input type="number" name="amount" placeHolder="Montant"/></br>
    <select name="type">
        <optgroup label="Debit">
            <option value="1">Alimentaire</option>
            <option value="2">Vestimentaire</option>
            <option value="3">Loisir</option>
            <option value="4">Transport</option>
            <option value="5">Logement</option>
            <option value="6">Autres</option>
        </optgroup>
        <optgroup label="Credit">
            <option value="7">Virement</option>
            <option value="8">Depot</option>
            <option value="9">Salaire</option>
            <option value="10">Autres</option>
        </optgroup>
    </select>
    <select name="paymentMethod">
        <option value="Carte Bleue">Carte Bleue</option>
        <option value="Cheque">Cheque</option>
        <option value="Virement">Virement</option>
        <option value="Prelevement">Prelevement</option>
    </select>
    <input type="submit" name="submitForm" value="Valider"/>
</form>
<form method="POST" action="delete.php">
    <select name="account">
        <option value="1">Test</option>
    </select>
    <input type="submit" name="submitCreate" value="Créer"/>
    <input type="submit" name="submitDelete" value="Supprimer"/>
</form>