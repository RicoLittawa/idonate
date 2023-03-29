<?php
require_once '../connection.php';
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    if ($category === "01") {
        $data = array();
        $labels = array();
        $cn = "SELECT productName, sum(quantity) as totalQuantity from categcannoodles  GROUP BY productName
        ORDER BY totalQuantity ASC ";
        $stmt = $conn->prepare($cn);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            array_unshift($data, $row['totalQuantity']);
            array_unshift($labels, $row['productName']);
        }
        $dataArray = array(
            'label' => 'Can and Noodles',
            'data' => $data,
            'labels' => $labels
        );
        echo json_encode($dataArray);
        $stmt->close();
        $conn->close();
    } else if ($category === "02") {
        $data = array();
        $labels = array();
        $cn = "SELECT productName, sum(quantity) as totalQuantity from categhygineessential  GROUP BY productName
        ORDER BY totalQuantity ASC ";
        $stmt = $conn->prepare($cn);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            array_unshift($data, $row['totalQuantity']);
            array_unshift($labels, $row['productName']);
        }
        $dataArray = array(
            'label' => 'Hygine Essentials',
            'data' => $data,
            'labels' => $labels
        );
        echo json_encode($dataArray);
        $stmt->close();
        $conn->close();
    } else if ($category === "03") {
        $data = array();
        $labels = array();
        $cn = "SELECT productName, sum(quantity) as totalQuantity from categinfant  GROUP BY productName
        ORDER BY totalQuantity ASC ";
        $stmt = $conn->prepare($cn);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            array_unshift($data, $row['totalQuantity']);
            array_unshift($labels, $row['productName']);
        }
        $dataArray = array(
            'label' => 'Infant Items',
            'data' => $data,
            'labels' => $labels
        );
        echo json_encode($dataArray);
        $stmt->close();
        $conn->close();
    } else if ($category === "04") {
        $data = array();
        $labels = array();
        $cn = "SELECT productName, sum(quantity) as totalQuantity from categdrinkingwater  GROUP BY productName
        ORDER BY totalQuantity ASC ";
        $stmt = $conn->prepare($cn);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            array_unshift($data, $row['totalQuantity']);
            array_unshift($labels, $row['productName']);
        }
        $dataArray = array(
            'label' => 'Drinking Water',
            'data' => $data,
            'labels' => $labels
        );
        echo json_encode($dataArray);
        $stmt->close();
        $conn->close();
    } else if ($category === "05") {
        $data = array();
        $labels = array();
        $cn = "SELECT productName, sum(quantity) as totalQuantity from categmeatgrains  GROUP BY productName
        ORDER BY totalQuantity ASC ";
        $stmt = $conn->prepare($cn);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            array_unshift($data, $row['totalQuantity']);
            array_unshift($labels, $row['productName']);
        }
        $dataArray = array(
            'label' => 'Meat and Grains',
            'data' => $data,
            'labels' => $labels
        );
        echo json_encode($dataArray);
        $stmt->close();
        $conn->close();
    } else if ($category === "06") {
        $data = array();
        $labels = array();
        $cn = "SELECT productName, sum(quantity) as totalQuantity from categmedicine  GROUP BY productName
        ORDER BY totalQuantity ASC ";
        $stmt = $conn->prepare($cn);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            array_unshift($data, $row['totalQuantity']);
            array_unshift($labels, $row['productName']);
        }
        $dataArray = array(
            'label' => 'Medicine',
            'data' => $data,
            'labels' => $labels
        );
        echo json_encode($dataArray);
        $stmt->close();
        $conn->close();
    } else if ($category === "07") {
        $data = array();
        $labels = array();
        $cn = "SELECT productName, sum(quantity) as totalQuantity from categothers  GROUP BY productName
        ORDER BY totalQuantity ASC ";
        $stmt = $conn->prepare($cn);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            array_unshift($data, $row['totalQuantity']);
            array_unshift($labels, $row['productName']);
        }
        $dataArray = array(
            'label' => 'Others',
            'data' => $data,
            'labels' => $labels
        );
        echo json_encode($dataArray);
        $stmt->close();
        $conn->close();
    }
}
