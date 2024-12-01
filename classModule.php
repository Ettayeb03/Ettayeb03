<?php

class Module {

    public $id;
    public $ModuleName;

    // Sélectionner tous les modules
    public static function selectAllModules($conn) {
        // Sélectionner tous les modules depuis la base de données
        $sql = "SELECT id, nom FROM Modules";
        $result = mysqli_query($conn, $sql);
        $modules = [];

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $modules[] = $row;
            }
        }

        return $modules;
    }

    // Sélectionner un module par son ID
    static function selectModuleById($conn, $id) {
        $sql = "SELECT nom FROM Modules WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }

        return null;
    }
}
?>
