function db_get($tablename, $id=null) {
    global $bdd;

    $data = [];
    $q = "SELECT * FROM ". $tablename;
    If (!is_null($id)){
    $q .= "WHERE id =". $id;
    }
    foreach($bdd->query($q) as $row) {
        $data[]=$row;
        echo $row;
    }

    return $data;
}

$annonce = db_get('annonce');


echo $annonce['id'];