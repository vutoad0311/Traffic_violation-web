<?php

function normalizePlate($plate)
{
    $plate = strtoupper(trim($plate));

    $plate = preg_replace('/[^A-Z0-9]/', '', $plate);

    return $plate;
}


function searchVehicleByPlate($conn, $plate)
{
    $plate = normalizePlate($plate);

    $sql = "
        SELECT *
        FROM vehicles
        WHERE REGEXP_REPLACE(
                UPPER(license_plate),
                '[^A-Z0-9]',
                '',
                'g'
              ) = :plate
        LIMIT 1
    ";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':plate' => $plate
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}