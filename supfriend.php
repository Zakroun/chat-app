<?php
require('connexion.php');
// Check if iduser is set and is not empty
if(isset($_GET['iduser']) && !empty($_GET['iduser'])) {
    $iduser = trim($_GET['iduser']);

    try {
        // Get the friend's ID
        $sql1 = "SELECT `idfriend` FROM `friends` WHERE `iduser` = :iduser";
        $stmt1 = $con->prepare($sql1);
        $stmt1->execute([':iduser' => $iduser]);
        $friend = $stmt1->fetch(PDO::FETCH_ASSOC);

        if ($friend) {
            $idfriend = $friend['idfriend'];

            // Start a transaction
            $con->beginTransaction();

            // Delete related records in answers table
            $sql2 = "DELETE FROM `answers` WHERE `idreceiver` = :idfriend";
            $stmt2 = $con->prepare($sql2);
            $stmt2->execute([':idfriend' => $idfriend]);

            // Delete related records in messages table
            $sql3 = "DELETE FROM `messages` WHERE `idreceiver` = :idfriend";
            $stmt3 = $con->prepare($sql3);
            $stmt3->execute([':idfriend' => $idfriend]);

            // Delete the friend record
            $sql4 = "DELETE FROM `friends` WHERE `idfriend` = :idfriend";
            $stmt4 = $con->prepare($sql4);
            $stmt4->execute([':idfriend' => $idfriend]);

            // Commit the transaction
            $con->commit();

            echo "<script>alert('Friend record deleted successfully');</script>";
        } else {
            echo "<script>alert('Friend not found');</script>";
        }
    } catch (PDOException $e) {
        // Roll back the transaction on error
        $con->rollBack();
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
} else {
    echo "<script>alert('Invalid request');</script>";
}

// Redirect back to contact.php
echo '<script>window.location.href = "listcontact.php?iduser=' . $iduser . '";</script>';
exit();
