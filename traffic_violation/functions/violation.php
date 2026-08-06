<?php

function getViolationsByVehicle($conn, $vehicleId)
{
    $sql = "SELECT *
            FROM violations
            WHERE vehicle_id = :vehicle_id
            ORDER BY violated_at DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':vehicle_id', $vehicleId);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}